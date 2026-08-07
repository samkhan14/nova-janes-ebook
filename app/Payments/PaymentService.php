<?php

namespace App\Payments;

use App\Mail\ShopOrderMail;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\SiteSetting;
use App\Payments\Contracts\PaymentGatewayInterface;
use App\Shop\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class PaymentService
{
    public function __construct(private PaymentGatewayInterface $gateway) {}

    /**
     * Save a pending order from the cart, then open a PayPal order.
     *
     * @return array{order: Order, paypal_order_id: string}
     */
    public function startPaypalCheckout(array $customer): array
    {
        if (Cart::isEmpty()) {
            throw new RuntimeException('Your cart is empty.');
        }

        $order = DB::transaction(function () use ($customer) {
            $order = Order::create([
                'order_number' => $this->makeOrderNumber(),
                'status' => 'pending_payment',
                'customer_name' => $customer['customer_name'],
                'customer_email' => $customer['customer_email'],
                'customer_phone' => $customer['customer_phone'] ?? null,
                'shipping_address_line1' => $customer['shipping_address_line1'],
                'shipping_address_line2' => $customer['shipping_address_line2'] ?? null,
                'shipping_city' => $customer['shipping_city'],
                'shipping_state' => $customer['shipping_state'] ?? null,
                'shipping_postal_code' => $customer['shipping_postal_code'],
                'shipping_country' => strtoupper($customer['shipping_country']),
                'notes' => $customer['notes'] ?? null,
                'subtotal' => Cart::subtotal(),
                'shipping_fee' => Cart::shipping(),
                'total' => Cart::total(),
                'currency' => config('payments.currency', 'USD'),
                'payment_method' => $this->gateway->name(),
            ]);

            foreach (Cart::items() as $row) {
                $variant = $row['variant'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $variant->product_id,
                    'product_variant_id' => $variant->id,
                    'product_title' => $variant->product->title,
                    'variant_label' => $variant->label,
                    'format' => $variant->format,
                    'quantity' => $row['qty'],
                    'unit_price' => $variant->price,
                    'line_total' => $row['line_total'],
                ]);
            }

            return $order;
        });

        // Same key = PayPal won't create a duplicate if this request is retried
        $paypal = $this->gateway->createOrder($order, 'create-'.$order->order_number);

        Payment::updateOrCreate(
            [
                'gateway' => $this->gateway->name(),
                'gateway_order_id' => $paypal['id'],
            ],
            [
                'order_id' => $order->id,
                'idempotency_key' => 'create-'.$order->order_number,
                'amount' => $order->total,
                'currency' => $order->currency,
                'status' => 'pending',
                'raw_response' => $paypal['raw'],
            ]
        );

        $order->update(['payment_reference' => $paypal['id']]);

        return [
            'order' => $order,
            'paypal_order_id' => $paypal['id'],
        ];
    }

    /**
     * Capture PayPal payment, then mark order paid + create invoice.
     * Safe to call again with the same PayPal order id.
     *
     * @return array{order: Order, invoice: Invoice, already_paid: bool}
     */
    public function finishPaypalCheckout(Order $order, string $paypalOrderId): array
    {
        // Already done? Return what we have.
        $done = Payment::query()
            ->where('gateway', $this->gateway->name())
            ->where('gateway_order_id', $paypalOrderId)
            ->where('status', 'completed')
            ->first();

        if ($done || $order->isPaid()) {
            $payment = $done ?: $order->payments()->where('status', 'completed')->latest('id')->first();

            if (! $payment) {
                throw new RuntimeException('Order is marked paid but no payment record was found.');
            }

            if (! $order->isPaid()) {
                $this->markPaid($order, $payment);
            }

            $invoice = $this->ensureInvoice($order, $payment);

            return [
                'order' => $order->fresh(['items', 'invoice', 'payments']),
                'invoice' => $invoice,
                'already_paid' => true,
            ];
        }

        $idempotencyKey = 'capture-'.$order->order_number.'-'.$paypalOrderId;
        $capture = $this->gateway->captureOrder($paypalOrderId, $idempotencyKey);

        if (! $capture['ok']) {
            Payment::updateOrCreate(
                [
                    'gateway' => $this->gateway->name(),
                    'gateway_order_id' => $paypalOrderId,
                ],
                [
                    'order_id' => $order->id,
                    'idempotency_key' => $idempotencyKey,
                    'amount' => $order->total,
                    'currency' => $order->currency,
                    'status' => 'failed',
                    'raw_response' => $capture['raw'],
                ]
            );

            throw new RuntimeException($capture['error'] ?: 'Payment was not completed.');
        }

        // Same capture id already stored (PayPal retry)
        if ($capture['capture_id']) {
            $existing = Payment::query()->where('gateway_capture_id', $capture['capture_id'])->first();

            if ($existing?->isCompleted()) {
                $this->markPaid($existing->order, $existing);
                $invoice = $this->ensureInvoice($existing->order, $existing);

                return [
                    'order' => $existing->order->fresh(['items', 'invoice', 'payments']),
                    'invoice' => $invoice,
                    'already_paid' => true,
                ];
            }
        }

        DB::transaction(function () use ($order, $paypalOrderId, $capture, $idempotencyKey) {
            $payment = Payment::updateOrCreate(
                [
                    'gateway' => $this->gateway->name(),
                    'gateway_order_id' => $paypalOrderId,
                ],
                [
                    'order_id' => $order->id,
                    'gateway_capture_id' => $capture['capture_id'],
                    'idempotency_key' => $idempotencyKey,
                    'amount' => $capture['amount'] ?? $order->total,
                    'currency' => $capture['currency'] ?? $order->currency,
                    'status' => 'completed',
                    'raw_response' => $capture['raw'],
                    'paid_at' => now(),
                ]
            );

            $this->markPaid($order, $payment);
            $this->ensureInvoice($order->fresh(), $payment);
        });

        Cart::clear();
        $this->emailReceipts($order->fresh(['items', 'invoice']));

        $order = $order->fresh(['items', 'invoice', 'payments']);

        return [
            'order' => $order,
            'invoice' => $order->invoice,
            'already_paid' => false,
        ];
    }

    private function markPaid(Order $order, Payment $payment): void
    {
        $order->update([
            'status' => 'paid',
            'payment_method' => $payment->gateway,
            'payment_reference' => $payment->gateway_capture_id ?: $payment->gateway_order_id,
        ]);
    }

    private function ensureInvoice(Order $order, Payment $payment): Invoice
    {
        $invoice = Invoice::query()->where('order_id', $order->id)->first();

        if ($invoice) {
            if ($invoice->status !== 'paid') {
                $invoice->update([
                    'payment_id' => $payment->id,
                    'status' => 'paid',
                    'paid_at' => $payment->paid_at ?? now(),
                ]);
            }

            return $invoice->fresh();
        }

        return Invoice::create([
            'order_id' => $order->id,
            'payment_id' => $payment->id,
            'invoice_number' => $this->makeInvoiceNumber(),
            'subtotal' => $order->subtotal,
            'shipping_fee' => $order->shipping_fee,
            'total' => $order->total,
            'currency' => $order->currency,
            'status' => 'paid',
            'issued_at' => now(),
            'paid_at' => $payment->paid_at ?? now(),
        ]);
    }

    private function emailReceipts(Order $order): void
    {
        try {
            $admin = SiteSetting::getValue('contact_email') ?: config('mail.contact_to');
            Mail::to($admin)->send(new ShopOrderMail($order, forCustomer: false));
            Mail::to($order->customer_email)->send(new ShopOrderMail($order, forCustomer: true));
        } catch (Throwable $e) {
            report($e);
        }
    }

    private function makeOrderNumber(): string
    {
        do {
            $number = 'JM-'.now()->format('ymd').'-'.Str::upper(Str::random(5));
        } while (Order::query()->where('order_number', $number)->exists());

        return $number;
    }

    private function makeInvoiceNumber(): string
    {
        do {
            $number = 'INV-'.now()->format('ymd').'-'.Str::upper(Str::random(5));
        } while (Invoice::query()->where('invoice_number', $number)->exists());

        return $number;
    }
}

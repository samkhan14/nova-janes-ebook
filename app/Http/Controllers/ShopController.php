<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Payments\PaymentService;
use App\Services\CmsContentService;
use App\Shop\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class ShopController extends Controller
{
    public function __construct(
        private CmsContentService $cms,
        private PaymentService $payments,
    ) {}

    public function books(): View
    {
        $books = Product::query()
            ->where('is_active', true)
            ->with('activeVariants')
            ->orderBy('sort_order')
            ->get();

        return view('shop.books', $this->page([
            'products' => $books,
            'metaDescription' => 'Shop Jane Mansons print books — paperback and hardcover. Ebooks on Amazon.',
        ]));
    }

    public function book(Product $product): View
    {
        abort_unless($product->is_active, 404);
        $product->load('activeVariants');

        return view('shop.show', $this->page([
            'product' => $product,
            'shippingFee' => Cart::shipping() ?: (float) config('shop.shipping_fee'),
            'metaDescription' => $product->description,
        ]));
    }

    public function cart(): View
    {
        return view('shop.cart', $this->page([
            'items' => Cart::items(),
            'subtotal' => Cart::subtotal(),
            'shippingFee' => Cart::shipping(),
            'total' => Cart::total(),
        ]));
    }

    public function addToCart(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'variant_id' => ['required', 'integer', 'exists:product_variants,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:20'],
        ]);

        $variant = ProductVariant::with('product')->findOrFail($data['variant_id']);

        if (! in_array($variant->format, ['paperback', 'hardcover'], true)) {
            return $this->cartError($request, 'Only paperback and hardcover can be ordered here.', 'variant_id');
        }

        if (! $variant->is_active || ! $variant->product?->is_active) {
            return $this->cartError($request, 'This book is not available right now.', 'variant_id');
        }

        Cart::add($variant->id, (int) ($data['quantity'] ?? 1));
        $message = $variant->product->title.' ('.$variant->label.') added to cart.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'cart' => Cart::summary(),
            ]);
        }

        return redirect()->route('cart.index')->with('status', $message);
    }

    public function updateCart(Request $request, ProductVariant $variant): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:20'],
        ]);

        Cart::setQty($variant->id, (int) $data['quantity']);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated.',
                'cart' => Cart::summary(),
            ]);
        }

        return back()->with('status', 'Cart updated.');
    }

    public function removeFromCart(Request $request, ProductVariant $variant): JsonResponse|RedirectResponse
    {
        Cart::remove($variant->id);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed.',
                'cart' => Cart::summary(),
            ]);
        }

        return back()->with('status', 'Item removed.');
    }

    public function checkout(): View|RedirectResponse
    {
        if (Cart::isEmpty()) {
            return redirect()->route('books.index')->with('status', 'Your cart is empty.');
        }

        $clientId = config('payments.paypal.client_id');
        $secret = config('payments.paypal.client_secret');

        return view('shop.checkout', $this->page([
            'items' => Cart::items(),
            'subtotal' => Cart::subtotal(),
            'shippingFee' => Cart::shipping(),
            'total' => Cart::total(),
            'paymentNote' => 'Pay with PayPal. Your order is confirmed only after payment succeeds.',
            'paypalClientId' => $clientId,
            'paypalConfigured' => filled($clientId) && filled($secret),
            'currency' => config('payments.currency', 'USD'),
        ]));
    }

    /** PayPal button: createOrder */
    public function createPaypalOrder(Request $request): JsonResponse
    {
        if (Cart::isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Your cart is empty.'], 422);
        }

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_email' => ['required', 'email', 'max:150'],
            'customer_phone' => ['nullable', 'string', 'max:40'],
            'shipping_address_line1' => ['required', 'string', 'max:180'],
            'shipping_address_line2' => ['nullable', 'string', 'max:180'],
            'shipping_city' => ['required', 'string', 'max:100'],
            'shipping_state' => ['nullable', 'string', 'max:80'],
            'shipping_postal_code' => ['required', 'string', 'max:20'],
            'shipping_country' => ['required', 'string', 'size:2'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            $result = $this->payments->startPaypalCheckout($data);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Unable to start PayPal checkout.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'id' => $result['paypal_order_id'],
            'order_number' => $result['order']->order_number,
        ]);
    }

    /** PayPal button: onApprove */
    public function capturePaypalOrder(Request $request): JsonResponse
    {
        $data = $request->validate([
            'order_number' => ['required', 'string', 'exists:orders,order_number'],
            'paypal_order_id' => ['required', 'string'],
        ]);

        $order = Order::query()->where('order_number', $data['order_number'])->firstOrFail();

        try {
            $result = $this->payments->finishPaypalCheckout($order, $data['paypal_order_id']);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Payment capture failed.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'already_paid' => $result['already_paid'],
            'order_number' => $result['order']->order_number,
            'invoice_number' => $result['invoice']->invoice_number,
            'redirect' => route('checkout.success', $result['order']),
        ]);
    }

    public function thankYou(Order $order): View
    {
        $order->load(['items', 'invoice', 'payments']);

        return view('shop.success', $this->page([
            'order' => $order,
            'invoice' => $order->invoice,
            'payment' => $order->payments()->where('status', 'completed')->latest('id')->first(),
        ]));
    }

    private function page(array $extra = []): array
    {
        return array_merge([
            'header' => $this->cms->header(),
            'footer' => $this->cms->footer(),
            'cartCount' => Cart::count(),
            'currencySymbol' => config('shop.currency_symbol', '$'),
        ], $extra);
    }

    private function cartError(Request $request, string $message, string $field): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors' => [$field => [$message]],
            ], 422);
        }

        return back()->withErrors([$field => $message]);
    }
}

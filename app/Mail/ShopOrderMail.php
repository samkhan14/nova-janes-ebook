<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShopOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order,
        public bool $forCustomer = false,
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->forCustomer
            ? 'We received your Jane Mansons order '.$this->order->order_number
            : 'New print order '.$this->order->order_number;

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.shop-order',
            with: [
                'order' => $this->order,
                'forCustomer' => $this->forCustomer,
                'currencySymbol' => config('shop.currency_symbol', '$'),
                'paymentNote' => config('shop.payment_note'),
            ],
        );
    }
}

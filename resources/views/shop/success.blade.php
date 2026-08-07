@extends('layouts.site')

@section('title', 'Order '.$order->order_number.' | Jane Mansons')

@section('content')
    <div class="page page--books">
        <section class="books-banner section--ochre">
            <x-site.header />
            <x-site.shop-bar :cart-count="$cartCount" />

            <div class="site-container books-banner__inner" data-reveal="fade-up">
                <span class="eyebrow books-banner__eyebrow">
                    {{ $order->isPaid() ? 'Paid' : 'Thank you' }}
                </span>
                <h1 class="books-banner__title">
                    {{ $order->isPaid() ? 'Payment successful' : 'Order received' }}
                </h1>
            </div>
        </section>

        <section class="section section--white books-page">
            <div class="site-container shop-panel shop-success" data-reveal="fade-up">
                @if ($order->isPaid())
                    <p class="shop-flash">
                        Order <strong>{{ $order->order_number }}</strong> is paid and confirmed.
                        @if ($invoice)
                            Invoice <strong>{{ $invoice->invoice_number }}</strong>.
                        @endif
                    </p>
                    <p>A confirmation email was sent to <strong>{{ $order->customer_email }}</strong>.</p>
                @else
                    <p class="shop-flash">Order <strong>{{ $order->order_number }}</strong> is waiting for payment.</p>
                @endif

                <div class="shop-summary">
                    <h2 class="shop-section-title">Summary</h2>
                    <ul class="shop-summary-list">
                        @foreach ($order->items as $item)
                            <li>
                                <span>{{ $item->product_title }} ({{ $item->variant_label }}) × {{ $item->quantity }}</span>
                                <strong>{{ $currencySymbol }}{{ number_format((float) $item->line_total, 2) }}</strong>
                            </li>
                        @endforeach
                    </ul>
                    <p>Subtotal: <strong>{{ $currencySymbol }}{{ number_format((float) $order->subtotal, 2) }}</strong></p>
                    <p>Shipping: <strong>{{ $currencySymbol }}{{ number_format((float) $order->shipping_fee, 2) }}</strong></p>
                    <p class="shop-summary__total">Total: <strong>{{ $currencySymbol }}{{ number_format((float) $order->total, 2) }}</strong></p>

                    @if ($payment)
                        <p class="book-detail__note mb-0">
                            Paid via {{ strtoupper($payment->gateway) }}
                            @if ($payment->gateway_capture_id)
                                · Ref {{ $payment->gateway_capture_id }}
                            @endif
                        </p>
                    @endif
                </div>

                <div class="shop-summary__actions">
                    <a class="btn-pill btn-pill--dark" href="{{ route('books.index') }}">Back to My Books</a>
                    <a class="btn-pill btn-pill--outline" href="{{ url('/') }}">Home</a>
                </div>
            </div>
        </section>

        <x-site.shop-footer :footer="$footer" />
    </div>
@endsection

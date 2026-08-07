@extends('layouts.site')

@section('title', 'Checkout | Jane Mansons')

@section('content')
    <div class="page page--books">
        <section class="books-banner section--ochre">
            <x-site.header />
            <x-site.shop-bar :cart-count="$cartCount" />

            <div class="site-container books-banner__inner" data-reveal="fade-up">
                <span class="eyebrow books-banner__eyebrow">Print shop</span>
                <h1 class="books-banner__title">Checkout</h1>
            </div>
        </section>

        <section class="section section--white books-page">
            <div class="site-container shop-checkout" data-reveal="fade-up">
                <form id="checkout-form" class="shop-checkout__form"
                      data-create-url="{{ route('checkout.paypal.create') }}"
                      data-capture-url="{{ route('checkout.paypal.capture') }}">
                    @csrf

                    <div class="shop-checkout__fields">
                        <h2 class="shop-section-title">Contact</h2>
                        <div class="shop-grid-2">
                            <div class="contact-form__field">
                                <input class="form-control" type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Full name" required>
                            </div>
                            <div class="contact-form__field">
                                <input class="form-control" type="email" name="customer_email" value="{{ old('customer_email') }}" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="contact-form__field">
                            <input class="form-control" type="text" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="Phone (optional)">
                        </div>

                        <h2 class="shop-section-title">Shipping address</h2>
                        <div class="contact-form__field">
                            <input class="form-control" type="text" name="shipping_address_line1" value="{{ old('shipping_address_line1') }}" placeholder="Address line 1" required>
                        </div>
                        <div class="contact-form__field">
                            <input class="form-control" type="text" name="shipping_address_line2" value="{{ old('shipping_address_line2') }}" placeholder="Address line 2 (optional)">
                        </div>
                        <div class="shop-grid-2">
                            <div class="contact-form__field">
                                <input class="form-control" type="text" name="shipping_city" value="{{ old('shipping_city') }}" placeholder="City" required>
                            </div>
                            <div class="contact-form__field">
                                <input class="form-control" type="text" name="shipping_state" value="{{ old('shipping_state') }}" placeholder="State / Province">
                            </div>
                        </div>
                        <div class="shop-grid-2">
                            <div class="contact-form__field">
                                <input class="form-control" type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code') }}" placeholder="Postal code" required>
                            </div>
                            <div class="contact-form__field">
                                <select class="form-control" name="shipping_country" required>
                                    @php $country = old('shipping_country', 'US'); @endphp
                                    <option value="US" @selected($country === 'US')>United States</option>
                                    <option value="CA" @selected($country === 'CA')>Canada</option>
                                    <option value="GB" @selected($country === 'GB')>United Kingdom</option>
                                    <option value="AU" @selected($country === 'AU')>Australia</option>
                                    <option value="PK" @selected($country === 'PK')>Pakistan</option>
                                </select>
                            </div>
                        </div>
                        <div class="contact-form__field">
                            <textarea class="form-control" name="notes" rows="3" placeholder="Order notes (optional)">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <aside class="shop-checkout__summary">
                        <h2 class="shop-section-title">Order summary</h2>
                        <ul class="shop-summary-list">
                            @foreach ($items as $row)
                                <li>
                                    <span>{{ $row['variant']->product->title }} ({{ $row['variant']->label }}) × {{ $row['qty'] }}</span>
                                    <strong>{{ $currencySymbol }}{{ number_format($row['line_total'], 2) }}</strong>
                                </li>
                            @endforeach
                        </ul>
                        <p>Subtotal: <strong>{{ $currencySymbol }}{{ number_format($subtotal, 2) }}</strong></p>
                        <p>Shipping: <strong>{{ $currencySymbol }}{{ number_format($shippingFee, 2) }}</strong></p>
                        <p class="shop-summary__total">Total: <strong>{{ $currencySymbol }}{{ number_format($total, 2) }}</strong></p>
                        <p class="book-detail__note">{{ $paymentNote }}</p>

                        @if ($paypalConfigured)
                            <div id="paypal-button-container" class="shop-paypal"></div>
                            <p class="shop-error" id="paypal-error" hidden></p>
                        @else
                            <p class="shop-error">
                                PayPal is not configured yet. Add <code>PAYPAL_CLIENT_ID</code> and <code>PAYPAL_CLIENT_SECRET</code> to <code>.env</code>.
                            </p>
                        @endif

                        <p class="text-center mt-3 mb-0"><a class="shop-back" href="{{ route('cart.index') }}">← Back to cart</a></p>
                    </aside>
                </form>
            </div>
        </section>

        <x-site.shop-footer :footer="$footer" />
    </div>

    @if ($paypalConfigured)
        <script src="https://www.paypal.com/sdk/js?client-id={{ urlencode($paypalClientId) }}&currency={{ urlencode($currency) }}&intent=capture"></script>
        <script>
            (function () {
                const form = document.getElementById('checkout-form');
                const errorEl = document.getElementById('paypal-error');
                const csrf = document.querySelector('meta[name="csrf-token"]')?.content
                    || form.querySelector('input[name="_token"]')?.value;
                let orderNumber = null;

                function showError(message) {
                    errorEl.hidden = false;
                    errorEl.textContent = message;
                }

                function formData() {
                    const data = {};
                    new FormData(form).forEach((value, key) => {
                        if (key !== '_token') data[key] = value;
                    });
                    return data;
                }

                paypal.Buttons({
                    style: { layout: 'vertical', color: 'gold', shape: 'pill', label: 'pay' },

                    onClick: function (_data, actions) {
                        errorEl.hidden = true;
                        return form.reportValidity() ? actions.resolve() : actions.reject();
                    },

                    createOrder: async function () {
                        const res = await fetch(form.dataset.createUrl, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf,
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            body: JSON.stringify(formData()),
                        });

                        const json = await res.json().catch(function () { return {}; });

                        if (!res.ok || !json.id) {
                            const msg = json.message || 'Unable to start PayPal.';
                            showError(msg);
                            throw new Error(msg);
                        }

                        orderNumber = json.order_number;
                        return json.id;
                    },

                    onApprove: async function (data) {
                        const res = await fetch(form.dataset.captureUrl, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf,
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            body: JSON.stringify({
                                order_number: orderNumber,
                                paypal_order_id: data.orderID,
                            }),
                        });

                        const json = await res.json().catch(function () { return {}; });

                        if (!res.ok || !json.success) {
                            const msg = json.message || 'Payment could not be completed.';
                            showError(msg);
                            throw new Error(msg);
                        }

                        window.location.href = json.redirect;
                    },

                    onError: function () {
                        showError('PayPal error. Please try again.');
                    },

                    onCancel: function () {
                        showError('Payment cancelled. You can try again when ready.');
                    },
                }).render('#paypal-button-container');
            })();
        </script>
    @endif
@endsection

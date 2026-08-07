@extends('layouts.site')

@section('title', 'Cart | Jane Mansons')

@section('content')
    <div class="page page--books">
        <section class="books-banner section--ochre">
            <x-site.header />
            <x-site.shop-bar :cart-count="$cartCount" />

            <div class="site-container books-banner__inner" data-reveal="fade-up">
                <span class="eyebrow books-banner__eyebrow">Print shop</span>
                <h1 class="books-banner__title">Your Cart</h1>
            </div>
        </section>

        <section class="section section--white books-page">
            <div class="site-container shop-panel" data-reveal="fade-up" data-cart-page>
                <p class="shop-flash" data-cart-flash @if (! session('status')) hidden @endif>{{ session('status') }}</p>

                <div data-cart-empty @if ($items !== []) hidden @endif>
                    <p class="gallery-empty">Your cart is empty.</p>
                    <p class="text-center"><a class="btn-pill btn-pill--dark" href="{{ route('books.index') }}">Browse My Books</a></p>
                </div>

                <div data-cart-filled @if ($items === []) hidden @endif>
                    <div class="shop-table-wrap">
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <th>Book</th>
                                    <th>Format</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody data-cart-rows>
                                @foreach ($items as $row)
                                    @php $variant = $row['variant']; @endphp
                                    <tr data-cart-row data-variant-id="{{ $variant->id }}">
                                        <td data-label="Book">
                                            <div class="shop-table__book">
                                                <img src="{{ $variant->product->coverUrl() }}" alt="" width="64" height="80">
                                                <span>{{ $variant->product->title }}</span>
                                            </div>
                                        </td>
                                        <td data-label="Format">{{ $variant->label }}</td>
                                        <td data-label="Qty">
                                            <form method="POST" action="{{ route('cart.update', $variant) }}" class="shop-qty-form" data-cart-update>
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" min="0" max="20" value="{{ $row['qty'] }}" aria-label="Quantity">
                                                <button type="submit" class="shop-link-btn">Update</button>
                                            </form>
                                        </td>
                                        <td data-label="Price" data-line-price>{{ $currencySymbol }}{{ number_format($row['line_total'], 2) }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('cart.destroy', $variant) }}" data-cart-remove>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="shop-link-btn shop-link-btn--danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="shop-summary">
                        <p>Subtotal: <strong data-cart-subtotal>{{ $currencySymbol }}{{ number_format($subtotal, 2) }}</strong></p>
                        <p>Shipping: <strong data-cart-shipping>{{ $currencySymbol }}{{ number_format($shippingFee, 2) }}</strong></p>
                        <p class="shop-summary__total">Total: <strong data-cart-total>{{ $currencySymbol }}{{ number_format($total, 2) }}</strong></p>
                        <div class="shop-summary__actions">
                            <a class="btn-pill btn-pill--outline" href="{{ route('books.index') }}">Continue shopping</a>
                            <a class="btn-pill btn-pill--dark" href="{{ route('checkout.create') }}">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-site.shop-footer :footer="$footer" />
    </div>
@endsection

@extends('layouts.site')

@section('title', $product->title.' | My Books | Jane Mansons')

@section('content')
    <div class="page page--books">
        <section class="books-banner section--ochre">
            <x-site.header />
            <x-site.shop-bar :cart-count="$cartCount" />

            <div class="site-container books-banner__inner" data-reveal="fade-up">
                <span class="eyebrow books-banner__eyebrow">{{ $product->tag ?? 'Print edition' }}</span>
                <h1 class="books-banner__title">{{ $product->title }}</h1>
            </div>
        </section>

        <section class="section section--white books-page">
            <div class="site-container">
                <div class="book-detail" data-reveal="fade-up" data-book-detail
                     data-shipping="{{ number_format($shippingFee, 2, '.', '') }}"
                     data-symbol="{{ $currencySymbol }}">
                    <div class="book-detail__media">
                        <img src="{{ $product->coverUrl() }}" alt="{{ $product->title }} cover" width="510" height="645">
                    </div>

                    <div class="book-detail__body">
                        <p class="book-detail__copy">{{ $product->description }}</p>

                        <form method="POST" action="{{ route('cart.add') }}" class="book-detail__form" data-cart-add>
                            @csrf

                            <fieldset class="book-detail__formats">
                                <legend>Choose format</legend>
                                @foreach ($product->activeVariants as $index => $variant)
                                    <label class="book-detail__format">
                                        <input
                                            type="radio"
                                            name="variant_id"
                                            value="{{ $variant->id }}"
                                            data-price="{{ number_format((float) $variant->price, 2, '.', '') }}"
                                            @checked(old('variant_id', $product->activeVariants->first()?->id) == $variant->id)
                                            required
                                        >
                                        <span>
                                            <strong>{{ $variant->label }}</strong>
                                            <em>{{ $currencySymbol }}{{ number_format((float) $variant->price, 2) }}</em>
                                        </span>
                                    </label>
                                @endforeach
                            </fieldset>
                            @error('variant_id')
                                <p class="shop-error">{{ $message }}</p>
                            @enderror

                            <div class="book-detail__qty">
                                <label for="quantity">Quantity</label>
                                <input id="quantity" type="number" name="quantity" min="1" max="20" value="{{ old('quantity', 1) }}" required>
                            </div>

                            <div class="book-detail__totals" aria-live="polite">
                                <p>Book total: <strong data-line-total>{{ $currencySymbol }}0.00</strong></p>
                                <p>Shipping (flat): <strong>{{ $currencySymbol }}{{ number_format($shippingFee, 2) }}</strong></p>
                                <p class="book-detail__grand">Estimated total: <strong data-grand-total>{{ $currencySymbol }}0.00</strong></p>
                            </div>

                            <div class="book-detail__actions">
                                <button type="submit" class="btn-pill btn-pill--dark" data-cart-submit>Add to cart</button>
                                @if ($product->amazon_ebook_url)
                                    <a class="btn-pill btn-pill--outline" href="{{ $product->amazon_ebook_url }}" target="_blank" rel="noopener noreferrer">
                                        Prefer ebook? Buy on Amazon
                                    </a>
                                @endif
                            </div>
                            <p class="shop-flash" data-cart-status hidden></p>
                        </form>

                        <p class="book-detail__note">
                            Print editions (paperback &amp; hardcover) ship to your address. Digital Kindle editions are sold on Amazon only.
                        </p>

                        <p><a class="shop-back" href="{{ route('books.index') }}">← Back to My Books</a></p>
                    </div>
                </div>
            </div>
        </section>

        <x-site.shop-footer :footer="$footer" />
    </div>
@endsection

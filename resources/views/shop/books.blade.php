@extends('layouts.site')

@section('title', 'My Books | Jane Mansons')

@section('content')
    <div class="page page--books">
        <section class="books-banner section--ochre">
            <x-site.header />
            <x-site.shop-bar :cart-count="$cartCount" />

            <div class="site-container books-banner__inner" data-reveal="fade-up">
                <span class="eyebrow books-banner__eyebrow">Shop the Collection</span>
                <h1 class="books-banner__title">My Books</h1>
                <p class="books-banner__lead">
                    Order <strong>Paperback</strong> or <strong>Hardcover</strong> print editions here.
                    Ebooks are available on Amazon Kindle.
                </p>
            </div>
        </section>

        <section class="section section--white books-page">
            <div class="site-container">
                @if (session('status'))
                    <p class="shop-flash" data-reveal="fade-up">{{ session('status') }}</p>
                @endif

                <div class="books-list">
                    @forelse ($products as $index => $product)
                        <article class="books-list__item" data-reveal="fade-up" @if($index) style="--reveal-delay: {{ number_format($index * 0.08, 2) }}s" @endif>
                            <div class="books-list__media">
                                <img
                                    src="{{ $product->coverUrl() }}"
                                    alt="{{ $product->title }} book cover"
                                    width="510"
                                    height="645"
                                    loading="lazy"
                                >
                            </div>
                            <div class="books-list__body">
                                @if ($product->tag)
                                    <span class="books-list__tag">{{ $product->tag }}</span>
                                @endif
                                <h2 class="books-list__name">{{ $product->title }}</h2>
                                <p class="books-list__copy">{{ $product->description }}</p>

                                @php
                                    $prices = $product->activeVariants->pluck('price', 'format');
                                    $symbol = config('shop.currency_symbol', '$');
                                @endphp
                                <p class="books-list__price">
                                    @if ($prices->has('paperback'))
                                        Paperback from {{ $symbol }}{{ number_format((float) $prices['paperback'], 2) }}
                                    @endif
                                    @if ($prices->has('paperback') && $prices->has('hardcover'))
                                        <span aria-hidden="true"> · </span>
                                    @endif
                                    @if ($prices->has('hardcover'))
                                        Hardcover {{ $symbol }}{{ number_format((float) $prices['hardcover'], 2) }}
                                    @endif
                                </p>

                                <div class="books-list__actions">
                                    <x-site.button :href="route('books.show', $product)" variant="dark">
                                        Order print edition
                                    </x-site.button>
                                    @if ($product->amazon_ebook_url)
                                        <x-site.button :href="$product->amazon_ebook_url" variant="outline">
                                            Ebook on Amazon
                                        </x-site.button>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="gallery-empty">Books coming soon.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <x-site.shop-footer :footer="$footer" />
    </div>
@endsection

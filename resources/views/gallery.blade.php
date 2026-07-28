@extends('layouts.site')

@section('title', 'Gallery | Jane Mansons')

@section('content')
    <div class="page page--gallery">
        <section class="books-banner section--ochre">
            <x-site.header />

            <div class="site-container books-banner__inner" data-reveal="fade-up">
                <span class="eyebrow books-banner__eyebrow">Moments &amp; Artwork</span>
                <h1 class="books-banner__title">Gallery</h1>
                <p class="books-banner__lead">
                    A look inside the Benny world — characters, covers, and story scenes filled with warmth and wonder.
                </p>
            </div>
        </section>

        <section class="section section--white gallery-page">
            <div class="site-container">
                @if (count($images))
                    <div class="gallery-masonry" data-reveal="fade-up" data-gallery>
                        @foreach ($images as $image)
                            <figure class="gallery-masonry__item">
                                <button
                                    type="button"
                                    class="gallery-masonry__trigger"
                                    data-gallery-open
                                    data-gallery-src="{{ asset($image['src']) }}"
                                    data-gallery-alt="{{ $image['alt'] }}"
                                    aria-label="View {{ $image['alt'] }}"
                                >
                                    <img
                                        src="{{ asset($image['src']) }}"
                                        alt="{{ $image['alt'] }}"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </button>
                            </figure>
                        @endforeach
                    </div>
                @else
                    <p class="gallery-empty" data-reveal="fade-up">
                        Gallery images coming soon. Place files in
                        <code>public/frontend/assets/images/gallery</code>.
                    </p>
                @endif
            </div>
        </section>

        <div class="gallery-lightbox" data-gallery-lightbox hidden>
            <button type="button" class="gallery-lightbox__close" data-gallery-close aria-label="Close image">
                ×
            </button>
            <img class="gallery-lightbox__image" data-gallery-image src="" alt="">
        </div>

        <footer class="site-footer site-footer--books">
            <div class="site-container">
                <p class="mb-0">
                    {{ str_replace('{year}', (string) date('Y'), $footer['copyright'] ?? '©Copyrights All Rights Reserved '.date('Y').' | Jane Mansons') }}
                </p>
            </div>
        </footer>
    </div>
@endsection

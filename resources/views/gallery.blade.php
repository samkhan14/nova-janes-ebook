@extends('layouts.site')

@section('title', ($gallery['title'] ?? 'Gallery').' | Jane Mansons')

@section('content')
    <div class="page page--gallery">
        <section class="books-banner section--ochre">
            <x-site.header />

            <div class="site-container books-banner__inner" data-reveal="fade-up">
                @if (!empty($gallery['eyebrow']))
                    <span class="eyebrow books-banner__eyebrow">{{ $gallery['eyebrow'] }}</span>
                @endif
                <h1 class="books-banner__title">{{ $gallery['title'] ?? "Benny's Little Readers" }}</h1>
                @if (!empty($gallery['lead']))
                    <p class="books-banner__lead">{{ $gallery['lead'] }}</p>
                @endif
            </div>
        </section>

        <section class="section section--white gallery-page">
            <audio
                class="gallery-audio"
                data-gallery-audio
                src="{{ asset("frontend/assets/videos/Benny's Buddies-gallery-song.mp3") }}"
                preload="auto"
                loop
                playsinline
            ></audio>
            <div class="site-container">
                @if (count($images))
                    <div class="gallery-masonry is-revealed" data-gallery>
                        @foreach ($images as $image)
                            <figure class="gallery-masonry__item">
                                <button
                                    type="button"
                                    class="gallery-masonry__trigger"
                                    data-gallery-open
                                    data-gallery-src="{{ $image['src'] }}"
                                    data-gallery-alt="{{ $image['alt'] }}"
                                    aria-label="View {{ $image['alt'] }}"
                                >
                                    <img
                                        src="{{ $image['src'] }}"
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
                        Gallery images coming soon.
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

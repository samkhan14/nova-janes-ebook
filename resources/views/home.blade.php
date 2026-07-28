@extends('layouts.site')

@section('title', ($siteName ?? 'Jane Mansons') . ' | Home')

@section('content')
@php
    use App\Support\CmsMedia;
    $hero = $home['hero'] ?? [];
    $about = $home['about'] ?? [];
    $books = $home['books']['items'] ?? [];
    $stanzas = $home['stanzas'] ?? [];
    $retail = $home['retail'] ?? [];
    $testimonials = $home['testimonials'] ?? [];
    $contact = $home['contact'] ?? [];
    $footerCopy = str_replace('{year}', date('Y'), $footer['copyright'] ?? ('©Copyrights All Rights Reserved ' . date('Y') . ' | Jane Mansons'));
@endphp
    <section class="section section--ochre hero" id="top">
        <x-site.header :header="$header" />

        <div class="hero__social" aria-label="Social links">
            @if (!empty($hero['instagram_url']))
            <a class="hero__social-link" href="{{ $hero['instagram_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path fill="currentColor"
                        d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2Zm0 2A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9a3.5 3.5 0 0 0 3.5-3.5v-9A3.5 3.5 0 0 0 16.5 4h-9Zm10.25 1.75a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" />
                </svg>
            </a>
            @endif
            @if (!empty($hero['facebook_url']))
            <a class="hero__social-link" href="{{ $hero['facebook_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path fill="currentColor" d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H8v3h3v7h3v-7h3l1-3h-4V9c0-.6.4-1 1-1Z" />
                </svg>
            </a>
            @endif
            @if (!empty($hero['threads_url']))
            <a class="hero__social-link" href="{{ $hero['threads_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Threads">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path fill="currentColor"
                        d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.589 12c.027 3.086.718 5.496 2.057 7.164 1.43 1.783 3.631 2.698 6.54 2.717 2.623-.02 4.358-.631 5.8-2.045 1.647-1.613 1.618-3.593 1.09-4.798-.31-.71-.873-1.3-1.634-1.75-.192 1.352-.622 2.446-1.284 3.272-.886 1.102-2.14 1.704-3.73 1.79-1.202.065-2.361-.218-3.259-.801-1.063-.689-1.685-1.74-1.752-2.964-.065-1.19.408-2.285 1.33-3.082.88-.76 2.119-1.207 3.583-1.291a13.853 13.853 0 0 1 3.02.142c-.126-.742-.375-1.332-.75-1.757-.513-.586-1.308-.883-2.359-.89h-.029c-.844 0-1.992.232-2.721 1.32L7.734 7.847c.98-1.454 2.568-2.256 4.478-2.256h.044c3.194.02 5.097 1.975 5.287 5.388.108.046.216.094.321.142 1.49.7 2.58 1.761 3.154 3.07.797 1.82.871 4.79-1.548 7.158-1.85 1.81-4.094 2.628-7.277 2.65Zm1.003-11.69c-.242 0-.487.007-.739.021-1.836.103-2.98.946-2.916 2.143.067 1.256 1.452 1.839 2.784 1.767 1.224-.065 2.818-.543 3.086-3.71a10.5 10.5 0 0 0-2.215-.221z" />
                </svg>
            </a>
            @endif
        </div>
    </section>

    <section class="section section--white" id="about">
        <div class="site-container author__grid">
            <div class="author__content" data-reveal="fade-right">
                <span class="eyebrow">{{ $about['eyebrow'] ?? 'About the Author' }}</span>
                <h2 class="author__title">{{ $about['title'] ?? 'Jane Mansons' }}</h2>
                <p class="author__copy">
                    {{ $about['copy'] ?? '' }}
                </p>
                <div class="author__actions">
                    <span class="author__follow-label">{{ $about['button_label'] ?? 'Follow On' }}</span>
                    <div class="author__social" aria-label="Social links">
                        @if (!empty($about['instagram_url']))
                        <a href="{{ $about['instagram_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <img src="{{ asset('frontend/assets/images/s1.png') }}" alt="" width="32"
                                height="32">
                        </a>
                        @endif
                        @if (!empty($about['facebook_url']))
                        <a href="{{ $about['facebook_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="author__social-link author__social-link--facebook">
                            <img src="{{ asset('frontend/assets/images/s2.png') }}" alt="" width="24"
                                height="24">
                        </a>
                        @endif
                        @if (!empty($about['threads_url']))
                        <a href="{{ $about['threads_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Threads">
                            <img src="{{ asset('frontend/assets/images/s3.png') }}" alt="" width="32"
                                height="32">
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="author__media" data-reveal="fade-left" style="--reveal-delay: 0.12s">
                <img src="{{ CmsMedia::url($about['image'] ?? null) }}"
                    alt="Author Jane Mansons with Benny the teddy bear" width="705" height="558" loading="lazy">
            </div>
        </div>
    </section>

    <section class="section section--ochre" id="books">
        <div class="site-container">
            @foreach ($books as $book)
                <x-site.book-feature
                    :label="$book['label'] ?? ''"
                    :title="$book['title'] ?? ''"
                    :copy="$book['copy'] ?? ''"
                    :image="$book['image'] ?? ''"
                    :image-alt="$book['image_alt'] ?? ''"
                    :image-width="(int) ($book['image_width'] ?? 499)"
                    :image-height="(int) ($book['image_height'] ?? 622)"
                    :image-side="$book['image_side'] ?? 'left'"
                    :button-href="$book['button_href'] ?? '#'"
                    :button-label="$book['button_label'] ?? 'Read More'"
                />
            @endforeach
        </div>
    </section>

    <section class="section section--white standards" id="standards">
        <img class="standards__art standards__art--left" src="{{ CmsMedia::url($stanzas['left_art'] ?? null) }}"
            alt="" width="337" height="776" loading="lazy" aria-hidden="true">

        <img class="standards__art standards__art--right" src="{{ CmsMedia::url($stanzas['right_art'] ?? null) }}"
            alt="" width="359" height="758" loading="lazy" aria-hidden="true">

        <div class="site-container">
            <div class="standards__heading" data-reveal="fade-up">
                <span class="eyebrow">{{ $stanzas['eyebrow'] ?? 'The Book' }}</span>
                <h2 class="section-heading">{{ $stanzas['heading'] ?? 'Stanzas' }}</h2>
            </div>

            <div class="standards__grid">
                @foreach (($stanzas['cards'] ?? []) as $index => $card)
                    <article class="standard-card" data-reveal="fade-up" style="--reveal-delay: {{ number_format(0.05 + ($index * 0.06), 2) }}s">
                        <h3>{{ $card['title'] ?? '' }}</h3>
                        <p>{{ $card['body'] ?? '' }}</p>
                        <span class="standard-card__page">{{ $card['page'] ?? '' }}</span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section--ochre section--banner" id="retail">
        <div class="site-container retail__grid">
            <div class="retail__media" data-reveal="fade-right">
                <img src="{{ CmsMedia::url($retail['image'] ?? null) }}"
                    alt="Benny books available in stores" width="950" height="641" loading="lazy">
            </div>

            <div class="retail__content" data-reveal="fade-left" style="--reveal-delay: 0.12s">
                <h2 class="retail__title">{{ $retail['title'] ?? '' }}</h2>
                <p class="retail__copy">
                    {{ $retail['copy'] ?? '' }}
                </p>
                <div class="retail__logos">
                    @if (!empty($retail['amazon_url']))
                    <a class="retail__logo-btn"
                        href="{{ $retail['amazon_url'] }}"
                        aria-label="Available at Amazon" target="_blank">
                        <img src="{{ CmsMedia::url($retail['amazon_logo'] ?? null) }}"
                            alt="Available at Amazon" width="314" height="150" loading="lazy">
                    </a>
                    @endif
                    @if (!empty($retail['bn_url']))
                    <a class="retail__logo-btn"
                        href="{{ $retail['bn_url'] }}"
                        aria-label="Barnes & Noble" target="_blank">
                        <img src="{{ CmsMedia::url($retail['bn_logo'] ?? null) }}" alt="Barnes & Noble"
                            width="314" height="150" loading="lazy">
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="section section--white" id="testimonials">
        <div class="site-container">
            <div class="testimonials__heading-wrap" data-reveal="fade-up">
                <img class="testimonials__deco testimonials__deco--yarn"
                    src="{{ CmsMedia::url($testimonials['deco_yarn'] ?? null) }}" alt="" width="160"
                    height="140" loading="lazy" aria-hidden="true">
                <h2 class="section-heading testimonials__title">{{ $testimonials['title'] ?? '' }}</h2>
                <img class="testimonials__deco testimonials__deco--glasses"
                    src="{{ CmsMedia::url($testimonials['deco_glasses'] ?? null) }}" alt="" width="120"
                    height="80" loading="lazy" aria-hidden="true">
            </div>

            <div class="testimonials__video" data-testimonials-video data-reveal="zoom" style="--reveal-delay: 0.1s">
                <video class="testimonials__video-el"
                    poster="{{ CmsMedia::url($testimonials['poster'] ?? null) }}" playsinline preload="metadata"
                    controlsList="nodownload">
                    <source src="{{ CmsMedia::url($testimonials['video'] ?? null) }}" type="video/mp4">
                </video>
                <button class="testimonials__play" type="button" aria-label="Play video">
                    <span class="testimonials__play-ring testimonials__play-ring--outer" aria-hidden="true"></span>
                    <span class="testimonials__play-ring testimonials__play-ring--mid" aria-hidden="true"></span>
                    <span class="testimonials__play-ring testimonials__play-ring--inner" aria-hidden="true"></span>
                    <span class="testimonials__play-btn" aria-hidden="true"></span>
                </button>
            </div>

            <div class="testimonials__slider" data-testimonials-slider data-reveal="fade-up"
                style="--reveal-delay: 0.18s">
                @foreach (($testimonials['items'] ?? []) as $item)
                    <div class="testimonials__slide">
                        <x-site.testimonial
                            :name="$item['name'] ?? ''"
                            :headline="$item['headline'] ?? ''"
                            :quote="$item['quote'] ?? ''"
                            :avatar="$item['avatar'] ?? ''"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section--ochre" id="contact">
        <div class="site-container contact__grid">
            <div class="contact__media" data-reveal="fade-right">
                <img src="{{ CmsMedia::url($contact['image'] ?? null) }}"
                    alt="Shop the Benny book collection" width="950" height="641" loading="lazy">
                <div class="contact__order">
                    <x-site.button href="{{ $contact['button_href'] ?? route('books.index') }}" variant="dark">{{ $contact['button_label'] ?? 'Order Now' }}</x-site.button>
                </div>
            </div>

            <div class="contact__content" data-reveal="fade-left" style="--reveal-delay: 0.12s">
                <h2 class="contact__title">{{ $contact['title'] ?? '' }}</h2>
                <x-site.contact-form />
            </div>
        </div>

        <footer class="site-footer">
            <div class="site-container">
                <p class="mb-0">{{ $footerCopy }}</p>
            </div>
        </footer>
    </section>
@endsection

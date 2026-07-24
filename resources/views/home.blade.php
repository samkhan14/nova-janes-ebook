@extends('layouts.app')

@section('title', 'Jane Mansons | Home')

@section('content')
    <section class="section section--ochre hero" id="top">
        <x-site.header />

        <div class="site-container hero__grid">
            <div class="hero__content" data-reveal="fade-up">
                <h1 class="hero__title">A Story About</h1>
                <p class="hero__subtitle">Connection, Friendship and the Power of Love</p>
                <div class="hero__actions">
                    <x-site.button href="#retail" variant="dark">Order Now</x-site.button>
                    <x-site.button href="#about" variant="outline">Read More</x-site.button>
                </div>
            </div>

            <div class="hero__books" data-reveal="fade-up" style="--reveal-delay: 0.15s">
                <img
                    src="{{ asset('frontend/assets/images/Group 1171276117_result.webp') }}"
                    alt="Benny book series covers"
                    width="950"
                    height="641"
                >
            </div>
        </div>
    </section>

    <section class="section section--white" id="about">
        <div class="site-container author__grid">
            <div class="author__content" data-reveal="fade-right">
                <span class="eyebrow">About the Author</span>
                <h2 class="author__title">Jane Mansons</h2>
                <p class="author__copy">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                    has been the industry's standard dummy text ever since 1966, when designers at Letraset
                    and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero
                    translation and scrambled it to make dummy text for Letraset's Body Type sheets. It has
                    survived not only many decades, but also the leap into electronic typesetting, remaining
                    essentially unchanged.
                </p>
                <div class="author__actions">
                    <x-site.button href="#contact" variant="dark">Follow On</x-site.button>
                    <div class="author__social" aria-label="Social links">
                        <a href="#" aria-label="Instagram">
                            <img src="{{ asset('frontend/assets/images/s1.png') }}" alt="" width="32" height="32">
                        </a>
                        <a href="#" aria-label="Facebook" class="author__social-link author__social-link--facebook">
                            <img src="{{ asset('frontend/assets/images/s2.png') }}" alt="" width="24" height="24">
                        </a>
                        <a href="#" aria-label="Threads">
                            <img src="{{ asset('frontend/assets/images/s3.png') }}" alt="" width="32" height="32">
                        </a>
                    </div>
                </div>
            </div>

            <div class="author__media" data-reveal="fade-left" style="--reveal-delay: 0.12s">
                <img
                    src="{{ asset('frontend/assets/images/Group 1171276125_result.webp') }}"
                    alt="Author Jane Mansons with Benny the teddy bear"
                    width="705"
                    height="558"
                    loading="lazy"
                >
            </div>
        </div>
    </section>

    <section class="section section--ochre" id="books">
        <div class="site-container">
            <x-site.book-feature
                label="Book 1"
                title="Benny & The Red Ear"
                copy="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset's Body Type sheets."
                image="frontend/assets/images/Group 1171276130.png"
                image-alt="Benny & The Red Ear book cover"
                :image-width="510"
                :image-height="645"
                image-side="left"
                button-href="#retail"
                button-label="Read More"
            />

            <x-site.book-feature
                label="Book 2"
                title="Benny Helps Mia See"
                copy="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset's Body Type sheets."
                image="frontend/assets/images/Group 1171276131.png"
                image-alt="Benny Helps Mia See book cover"
                :image-width="499"
                :image-height="622"
                image-side="right"
                button-href="#retail"
                button-label="Read More"
            />

            <x-site.book-feature
                label="Book 3"
                title="Benny and the Nighttime Brave"
                copy="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset's Body Type sheets."
                image="frontend/assets/images/Group 1171276105_result.webp"
                image-alt="Benny and the Nighttime Brave book cover"
                :image-width="499"
                :image-height="622"
                image-side="left"
                button-href="#retail"
                button-label="Read More"
            />
        </div>
    </section>

    <section class="section section--white standards" id="standards">
        <img
            class="standards__art standards__art--left"
            src="{{ asset('frontend/assets/images/Mia 1_result.webp') }}"
            alt=""
            width="337"
            height="776"
            loading="lazy"
            aria-hidden="true"
        >

        <img
            class="standards__art standards__art--right"
            src="{{ asset('frontend/assets/images/Sammy 1_result.webp') }}"
            alt=""
            width="359"
            height="758"
            loading="lazy"
            aria-hidden="true"
        >

        <div class="site-container">
            <div class="standards__heading" data-reveal="fade-up">
                <span class="eyebrow">The Book</span>
                <h2 class="section-heading">Stanzas</h2>
            </div>

            <div class="standards__grid">
                <article class="standard-card" data-reveal="fade-up" style="--reveal-delay: 0.05s">
                    <h3>BOOK 01 Lorem Ipsum is simply dummy</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard.</p>
                    <span class="standard-card__page">- Page no 05</span>
                </article>
                <article class="standard-card" data-reveal="fade-up" style="--reveal-delay: 0.12s">
                    <h3>BOOK 01 Lorem Ipsum is simply dummy</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard.</p>
                    <span class="standard-card__page">- Page no 05</span>
                </article>
                <article class="standard-card" data-reveal="fade-up" style="--reveal-delay: 0.18s">
                    <h3>BOOK 01 Lorem Ipsum is simply dummy</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard.</p>
                    <span class="standard-card__page">- Page no 05</span>
                </article>
                <article class="standard-card" data-reveal="fade-up" style="--reveal-delay: 0.24s">
                    <h3>BOOK 01 Lorem Ipsum is simply dummy</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard.</p>
                    <span class="standard-card__page">- Page no 05</span>
                </article>
            </div>

            <div class="standards__cta" data-reveal="fade-up" style="--reveal-delay: 0.1s">
                <x-site.button href="#books" variant="dark">Read More</x-site.button>
            </div>
        </div>
    </section>

    <section class="section section--ochre section--banner" id="retail">
        <div class="site-container retail__grid">
            <div class="retail__media" data-reveal="fade-right">
                <img
                    src="{{ asset('frontend/assets/images/Group 1171276117_result.webp') }}"
                    alt="Benny books available in stores"
                    width="950"
                    height="641"
                    loading="lazy"
                >
            </div>

            <div class="retail__content" data-reveal="fade-left" style="--reveal-delay: 0.12s">
                <h2 class="retail__title">Available on Amazon and Barnes &amp; Noble</h2>
                <p class="retail__copy">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                    has been the industry's standard dummy text ever since the 1500s.
                </p>
                <div class="retail__logos">
                    <a class="retail__logo-btn" href="#" aria-label="Available at Amazon">
                        <img
                            src="{{ asset('frontend/assets/images/Group 1171276127_result.webp') }}"
                            alt="Available at Amazon"
                            width="314"
                            height="150"
                            loading="lazy"
                        >
                    </a>
                    <a class="retail__logo-btn" href="#" aria-label="Barnes & Noble">
                        <img
                            src="{{ asset('frontend/assets/images/Group 1171276115_result.webp') }}"
                            alt="Barnes & Noble"
                            width="314"
                            height="150"
                            loading="lazy"
                        >
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Video Trailers section hidden for now
    <section class="section section--white" id="trailers">
        <div class="site-container">
            <x-site.section-heading title="Video Trailers" />

            <div class="section-tabs" role="tablist" aria-label="Video trailers">
                <button class="section-tabs__item is-active" type="button">Book 01</button>
                <span aria-hidden="true">|</span>
                <button class="section-tabs__item" type="button">Book 02</button>
                <span aria-hidden="true">|</span>
                <button class="section-tabs__item" type="button">Book 03</button>
            </div>

            <div class="trailers__stage">
                <div class="trailers__side trailers__side--left" aria-hidden="true">
                    <img src="{{ asset('frontend/assets/images/Mask group_result.webp') }}" alt="" loading="lazy">
                </div>

                <div class="trailers__player">
                    <img
                        src="{{ asset('frontend/assets/images/Mask group_result.webp') }}"
                        alt="Benny Helps Mia See trailer preview"
                        width="1030"
                        height="525"
                        loading="lazy"
                    >
                    <div class="trailers__overlay-title">
                        <span>Benney Helps</span>
                        <span>Mia See</span>
                    </div>
                    <button class="trailers__play" type="button" aria-label="Play Benny Helps Mia See trailer">
                        <span class="trailers__play-icon" aria-hidden="true"></span>
                    </button>
                </div>

                <div class="trailers__side trailers__side--right" aria-hidden="true">
                    <img src="{{ asset('frontend/assets/images/Mask group_result.webp') }}" alt="" loading="lazy">
                </div>
            </div>

            <div class="trailers__dots" aria-hidden="true">
                <span></span>
                <span class="is-active"></span>
                <span></span>
            </div>
        </div>
    </section>
    --}}

    <section class="section section--white" id="testimonials">
        <div class="site-container">
            <div class="testimonials__heading-wrap" data-reveal="fade-up">
                <img
                    class="testimonials__deco testimonials__deco--yarn"
                    src="{{ asset('frontend/assets/images/testimonials-yarn.png') }}"
                    alt=""
                    width="160"
                    height="140"
                    loading="lazy"
                    aria-hidden="true"
                >
                <h2 class="section-heading testimonials__title">What Benny's Buddies Say</h2>
                <img
                    class="testimonials__deco testimonials__deco--glasses"
                    src="{{ asset('frontend/assets/images/testimonials-glasses.png') }}"
                    alt=""
                    width="120"
                    height="80"
                    loading="lazy"
                    aria-hidden="true"
                >
            </div>

            <div class="testimonials__video" data-testimonials-video data-reveal="zoom" style="--reveal-delay: 0.1s">
                <video
                    class="testimonials__video-el"
                    poster="{{ asset('frontend/assets/images/Mask group_result.webp') }}"
                    playsinline
                    preload="metadata"
                    controlsList="nodownload"
                >
                    <source
                        src="{{ asset('frontend/assets/videos/testimonials.mp4') }}"
                        type="video/mp4"
                    >
                </video>
                <button class="testimonials__play" type="button" aria-label="Play video">
                    <span class="testimonials__play-ring testimonials__play-ring--outer" aria-hidden="true"></span>
                    <span class="testimonials__play-ring testimonials__play-ring--mid" aria-hidden="true"></span>
                    <span class="testimonials__play-ring testimonials__play-ring--inner" aria-hidden="true"></span>
                    <span class="testimonials__play-btn" aria-hidden="true"></span>
                </button>
            </div>

            <div class="testimonials__slider" data-testimonials-slider data-reveal="fade-up" style="--reveal-delay: 0.18s">
                <div class="testimonials__slide">
                    <x-site.testimonial
                        name="Lorem Ipsum"
                        headline="I Realy Appreciate!!"
                        quote="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                        avatar="frontend/assets/images/Mask group (1)_result.webp"
                    />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial
                        name="Lorem Ipsum"
                        headline="Very Impressive"
                        quote="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                        avatar="frontend/assets/images/Mask group (2)_result.webp"
                    />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial
                        name="Lorem Ipsum"
                        headline="Amazing!!"
                        quote="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                        avatar="frontend/assets/images/Mask group (1)_result.webp"
                    />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial
                        name="Lorem Ipsum"
                        headline="I Realy Appreciate!!"
                        quote="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                        avatar="frontend/assets/images/Mask group (2)_result.webp"
                    />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial
                        name="Lorem Ipsum"
                        headline="Very Impressive"
                        quote="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                        avatar="frontend/assets/images/Mask group (1)_result.webp"
                    />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial
                        name="Lorem Ipsum"
                        headline="Amazing!!"
                        quote="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                        avatar="frontend/assets/images/Mask group (2)_result.webp"
                    />
                </div>
            </div>
        </div>
    </section>

    <section class="section section--ochre" id="contact">
        <div class="site-container contact__grid">
            <div class="contact__media" data-reveal="fade-right">
                <img
                    src="{{ asset('frontend/assets/images/Group 1171276117_result.webp') }}"
                    alt="Shop the Benny book collection"
                    width="950"
                    height="641"
                    loading="lazy"
                >
                <div class="contact__order">
                    <x-site.button href="#retail" variant="dark">Order Now</x-site.button>
                </div>
            </div>

            <div class="contact__content" data-reveal="fade-left" style="--reveal-delay: 0.12s">
                <h2 class="contact__title">Contact Form</h2>
                <x-site.contact-form />
            </div>
        </div>

        <footer class="site-footer">
            <div class="site-container">
                <p class="mb-0">©Copyrights All Rights Reserved {{ date('Y') }} | Jane Mansons</p>
            </div>
        </footer>
    </section>
@endsection

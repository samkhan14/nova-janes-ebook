@extends('layouts.app')

@section('title', 'Jane Mansons | Home')

@section('content')
    <section class="section section--ochre hero" id="top">
        <x-site.header />

        <div class="site-container hero__grid">
            <div class="hero__content">
                <h1 class="hero__title">A Story About</h1>
                <p class="hero__subtitle">Connection, Friendship and the Power of Love</p>
                <div class="hero__actions">
                    <x-site.button href="#about" variant="dark">Shop Now</x-site.button>
                    <x-site.button href="#trailers" variant="outline">Watch Video</x-site.button>
                </div>
            </div>

            <div class="hero__books">
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
            <div class="author__content">
                <span class="eyebrow">About the Author</span>
                <h2 class="author__title">Jane Mansons</h2>
                <p class="author__copy">
                    Jane Mansons writes heartfelt children’s stories that celebrate kindness, courage,
                    and the little differences that make every child shine. Through Benny and friends,
                    her books invite families into warm moments of connection and love.
                </p>
                <x-site.button href="#contact" variant="dark">Read More</x-site.button>
            </div>

            <div class="author__media">
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
            @foreach ($books as $book)
                <x-site.book-feature
                    :label="$book['label']"
                    :title="$book['title']"
                    :copy="$book['copy']"
                    :image="$book['image']"
                    :image-alt="$book['imageAlt']"
                    :image-width="$book['imageWidth']"
                    :image-height="$book['imageHeight']"
                    :image-side="$book['imageSide']"
                    button-href="#retail"
                    button-label="Read More"
                />
            @endforeach
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
            <x-site.section-heading title="The Book Stanzas" />

            <div class="standards__grid">
                @foreach ($standards as $standard)
                    <article class="standard-card">
                        <h3>{{ $standard['title'] }}</h3>
                        <p>{{ $standard['copy'] }}</p>
                    </article>
                @endforeach
            </div>

            <div class="standards__cta">
                <x-site.button href="#books" variant="dark">Read More</x-site.button>
            </div>
        </div>
    </section>

    <section class="section section--ochre section--banner" id="retail">
        <div class="site-container retail__grid">
            <div class="retail__media">
                <img
                    src="{{ asset('frontend/assets/images/Group 1171276117_result.webp') }}"
                    alt="Benny books available in stores"
                    width="950"
                    height="641"
                    loading="lazy"
                >
            </div>

            <div class="retail__content">
                <h2 class="retail__title">Available on Amazon and Barnes &amp; Noble</h2>
                <p class="mb-4">Find the Benny series wherever you love to shop for children’s books.</p>
                <div class="retail__logos">
                    <a href="#" aria-label="Available at Amazon">
                        <img
                            src="{{ asset('frontend/assets/images/Group 1171276127_result.webp') }}"
                            alt="Available at Amazon"
                            width="314"
                            height="150"
                            loading="lazy"
                        >
                    </a>
                    <a href="#" aria-label="Barnes & Noble">
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

    <section class="section section--white" id="trailers">
        <div class="site-container">
            <x-site.section-heading title="Video Trailers" />

            <div class="trailers__player">
                <img
                    src="{{ asset('frontend/assets/images/Mask group_result.webp') }}"
                    alt="Benny Helps Mia See trailer preview"
                    width="1030"
                    height="525"
                    loading="lazy"
                >
                <button class="trailers__play" type="button" aria-label="Play Benny Helps Mia See trailer">
                    <span class="trailers__play-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

    <section class="section section--white" id="testimonials">
        <div class="site-container">
            <div class="testimonials__heading-wrap">
                <img
                    class="testimonials__pet"
                    src="{{ asset('frontend/assets/images/Pebbles 3_result.webp') }}"
                    alt=""
                    width="370"
                    height="375"
                    loading="lazy"
                    aria-hidden="true"
                >
                <x-site.section-heading title="What People Say" />
                <img
                    class="testimonials__pet testimonials__pet--flip"
                    src="{{ asset('frontend/assets/images/Pebbles 3_result.webp') }}"
                    alt=""
                    width="370"
                    height="375"
                    loading="lazy"
                    aria-hidden="true"
                >
            </div>

            <div class="testimonials__feature">
                <img
                    src="{{ asset('frontend/assets/images/Mask group_result.webp') }}"
                    alt="Family reading moment with Benny"
                    width="1030"
                    height="525"
                    loading="lazy"
                >
            </div>

            <div class="row g-4">
                @foreach ($testimonials as $testimonial)
                    <div class="col-md-4">
                        <x-site.testimonial
                            :name="$testimonial['name']"
                            :role="$testimonial['role']"
                            :quote="$testimonial['quote']"
                            :avatar="$testimonial['avatar']"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section--ochre" id="contact">
        <div class="site-container contact__grid">
            <div class="contact__media text-center text-md-start">
                <img
                    src="{{ asset('frontend/assets/images/Group 1171276117_result.webp') }}"
                    alt="Shop the Benny book collection"
                    width="950"
                    height="641"
                    loading="lazy"
                >
                <div class="mt-4">
                    <x-site.button href="#retail" variant="dark">Shop Now</x-site.button>
                </div>
            </div>

            <div class="contact__content">
                <h2 class="contact__title">Contact Form</h2>
                <x-site.contact-form />
            </div>
        </div>

        <footer class="site-footer">
            <div class="site-container">
                <p class="mb-0">Copyrights © All Rights Reserved {{ date('Y') }} | Jane Mansons</p>
            </div>
        </footer>
    </section>
@endsection

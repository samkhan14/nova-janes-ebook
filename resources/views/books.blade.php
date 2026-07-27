@extends('layouts.app')

@section('title', 'My Books | Jane Mansons')

@section('content')
    <div class="page page--books">
        <section class="books-banner section--ochre">
            <x-site.header />

            <div class="site-container books-banner__inner" data-reveal="fade-up">
                <span class="eyebrow books-banner__eyebrow">Shop the Collection</span>
                <h1 class="books-banner__title">My Books</h1>
                <p class="books-banner__lead">
                    Explore the Benny series — heartwarming stories about friendship, courage, and love.
                </p>
            </div>
        </section>

        <section class="section section--white books-page">
            <div class="site-container">
                <div class="books-list">
                    <article class="books-list__item" data-reveal="fade-up">
                        <div class="books-list__media">
                            <img
                                src="{{ asset('frontend/assets/images/Group 1171276130.png') }}"
                                alt="Benny & The Red Ear book cover"
                                width="510"
                                height="645"
                                loading="lazy"
                            >
                        </div>
                        <div class="books-list__body">
                            <span class="books-list__tag">Book 01</span>
                            <h2 class="books-list__name">Benny &amp; The Red Ear</h2>
                            <p class="books-list__copy">
                                A warm story about belonging, kindness, and the power of being uniquely you —
                                starring Benny, the red-eared bear.
                            </p>
                            <x-site.button
                                href="https://www.amazon.com/Benny-Red-Ear-Jane-Mansons-ebook/dp/B0FL13DQN7"
                                variant="dark"
                            >
                                Buy this product
                            </x-site.button>
                        </div>
                    </article>

                    <article class="books-list__item" data-reveal="fade-up" style="--reveal-delay: 0.08s">
                        <div class="books-list__media">
                            <img
                                src="{{ asset('frontend/assets/images/Group 1171276131.png') }}"
                                alt="Benny Helps Mia See book cover"
                                width="499"
                                height="622"
                                loading="lazy"
                            >
                        </div>
                        <div class="books-list__body">
                            <span class="books-list__tag">Book 02</span>
                            <h2 class="books-list__name">Benny Helps Mia See</h2>
                            <p class="books-list__copy">
                                When Mia struggles to see the chalkboard, Benny helps her find the courage to ask for help —
                                a touching story about confidence, kindness, and friendship.
                            </p>
                            <x-site.button
                                href="https://www.amazon.com/Benny-Helps-Mia-Jane-Mansons/dp/B0G29JSC41"
                                variant="dark"
                            >
                                Buy this product
                            </x-site.button>
                        </div>
                    </article>

                    <article class="books-list__item" data-reveal="fade-up" style="--reveal-delay: 0.16s">
                        <div class="books-list__media">
                            <img
                                src="{{ asset('frontend/assets/images/Group 1171276105_result.webp') }}"
                                alt="Benny and the Nighttime Brave book cover"
                                width="499"
                                height="622"
                                loading="lazy"
                            >
                        </div>
                        <div class="books-list__body">
                            <span class="books-list__tag">Book 03</span>
                            <h2 class="books-list__name">Benny and the Nighttime Brave</h2>
                            <p class="books-list__copy">
                                A heartwarming bedtime story about courage and confidence — Benny shows that being brave
                                doesn’t mean never being afraid.
                            </p>
                            <x-site.button
                                href="https://www.amazon.com/BENNY-NIGHTTIME-BRAVE-JANE-MANSONS-ebook/dp/B0H8B5QVHG"
                                variant="dark"
                            >
                                Buy this product
                            </x-site.button>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <footer class="site-footer site-footer--books">
            <div class="site-container">
                <p class="mb-0">©Copyrights All Rights Reserved {{ date('Y') }} | Jane Mansons</p>
            </div>
        </footer>
    </div>
@endsection

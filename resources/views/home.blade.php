@extends('layouts.app')

@section('title', 'Jane Mansons | Home')

@section('content')
    <section class="section section--ochre hero" id="top">
        <x-site.header />

        {{-- <div class="site-container hero__grid">
            <div class="hero__content" data-reveal="fade-up">
                <h1 class="hero__title">A Story About</h1>
                <p class="hero__subtitle">Connection, Friendship and the Power of Love</p>
                <div class="hero__actions">
                    <x-site.button href="{{ route('books.index') }}" variant="dark">Order Now</x-site.button>
                </div>
            </div>

            <div class="hero__books" data-reveal="fade-up" style="--reveal-delay: 0.15s">
                <img src="{{ asset('frontend/assets/images/Group 1171276117_result.webp') }}" alt="Benny book series covers"
                    width="950" height="641">
            </div>
        </div> --}}

        <div class="hero__social" aria-label="Social links">
            <a class="hero__social-link" href="https://www.instagram.com/author_jane_mansons?igsh=MW9qNHd0YzE1cWI4aw==" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path fill="currentColor"
                        d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2Zm0 2A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9a3.5 3.5 0 0 0 3.5-3.5v-9A3.5 3.5 0 0 0 16.5 4h-9Zm10.25 1.75a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" />
                </svg>
            </a>
            <a class="hero__social-link" href="https://www.facebook.com/share/1D4edKsnNz/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path fill="currentColor" d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H8v3h3v7h3v-7h3l1-3h-4V9c0-.6.4-1 1-1Z" />
                </svg>
            </a>
            <a class="hero__social-link" href="https://www.threads.net/@authorjanemansons" target="_blank" rel="noopener noreferrer" aria-label="Threads">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path fill="currentColor"
                        d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.589 12c.027 3.086.718 5.496 2.057 7.164 1.43 1.783 3.631 2.698 6.54 2.717 2.623-.02 4.358-.631 5.8-2.045 1.647-1.613 1.618-3.593 1.09-4.798-.31-.71-.873-1.3-1.634-1.75-.192 1.352-.622 2.446-1.284 3.272-.886 1.102-2.14 1.704-3.73 1.79-1.202.065-2.361-.218-3.259-.801-1.063-.689-1.685-1.74-1.752-2.964-.065-1.19.408-2.285 1.33-3.082.88-.76 2.119-1.207 3.583-1.291a13.853 13.853 0 0 1 3.02.142c-.126-.742-.375-1.332-.75-1.757-.513-.586-1.308-.883-2.359-.89h-.029c-.844 0-1.992.232-2.721 1.32L7.734 7.847c.98-1.454 2.568-2.256 4.478-2.256h.044c3.194.02 5.097 1.975 5.287 5.388.108.046.216.094.321.142 1.49.7 2.58 1.761 3.154 3.07.797 1.82.871 4.79-1.548 7.158-1.85 1.81-4.094 2.628-7.277 2.65Zm1.003-11.69c-.242 0-.487.007-.739.021-1.836.103-2.98.946-2.916 2.143.067 1.256 1.452 1.839 2.784 1.767 1.224-.065 2.818-.543 3.086-3.71a10.5 10.5 0 0 0-2.215-.221z" />
                </svg>
            </a>
        </div>
    </section>

    <section class="section section--white" id="about">
        <div class="site-container author__grid">
            <div class="author__content" data-reveal="fade-right">
                <span class="eyebrow">About the Author</span>
                <h2 class="author__title">Jane Mansons</h2>
                <p class="author__copy">
                    Jane Mansons is an author, advocate, and storyteller who believes every child deserves to see themselves
                    reflected in the stories they read. Through the Benny series, she creates heartfelt adventures that help
                    children navigate life’s challenges with courage, compassion, and confidence. Inspired by real life
                    experiences and the children who have touched her heart, Jane writes stories that encourage empathy,
                    celebrate differences, and remind young readers that their unique qualities are their greatest
                    strengths. Each story offers meaningful lessons filled with warmth and hope, whether Benny is embracing
                    what makes him different, helping a friend see the world in a new way, or finding the courage to face
                    his fears. Jane is passionate about inspiring young minds and fostering conversations about acceptance,
                    resilience, and emotional wellbeing. She believes stories can build confidence, spark understanding, and
                    empower children to face life’s adventures with a brave heart. When she’s not writing, Jane enjoys
                    spending time with her family, connecting with readers, and finding inspiration in everyday moments. She
                    hopes the adventures of Benny encourage young readers to be kind, be brave, believe in themselves, and
                    remember they are loved, just as they are.
                </p>
                <div class="author__actions">
                    <x-site.button href="#contact" variant="dark">Follow On</x-site.button>
                    <div class="author__social" aria-label="Social links">
                        <a href="https://www.instagram.com/author_jane_mansons?igsh=MW9qNHd0YzE1cWI4aw==" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <img src="{{ asset('frontend/assets/images/s1.png') }}" alt="" width="32"
                                height="32">
                        </a>
                        <a href="https://www.facebook.com/share/1D4edKsnNz/" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="author__social-link author__social-link--facebook">
                            <img src="{{ asset('frontend/assets/images/s2.png') }}" alt="" width="24"
                                height="24">
                        </a>
                        <a href="https://www.threads.net/@authorjanemansons" target="_blank" rel="noopener noreferrer" aria-label="Threads">
                            <img src="{{ asset('frontend/assets/images/s3.png') }}" alt="" width="32"
                                height="32">
                        </a>
                    </div>
                </div>
            </div>

            <div class="author__media" data-reveal="fade-left" style="--reveal-delay: 0.12s">
                <img src="{{ asset('frontend/assets/images/Group 1171276125_result.webp') }}"
                    alt="Author Jane Mansons with Benny the teddy bear" width="705" height="558" loading="lazy">
            </div>
        </div>
    </section>

    <section class="section section--ochre" id="books">
        <div class="site-container">
            <x-site.book-feature label="Book 1" title="Benny & The Red Ear"
                copy="When a summer storm leaves Benny the bear without an ear, Mia and Grandma repair him with the only yarn they have, bright red. In this sweet rhyming tale, Benny learns that what makes him different makes him special, and that love is the best thing to be stitched."
                image="frontend/assets/images/Group 1171276130.png" image-alt="Benny & The Red Ear book cover"
                :image-width="510" :image-height="645" image-side="left"
                button-href="https://www.amazon.com/Benny-Red-Ear-Jane-Mansons-ebook/dp/B0FL13DQN7/ref=sr_1_8?crid=2F085JF3GKWTX&dib=eyJ2IjoiMSJ9.GafRLrtTuX9XUWKGf0_C-NHf6oLhZsispyY0w_vBuRgaelZ6FaieE2AinidZipsb8VHD5tMZaQVGRcL2jOoyFp_mRjRFe2S7bkt1db4ArdlEGg28zWWwdqScy5WZRAXLmc5SdNN4sGIvOaL5hAs5yiZ42tT9lG8LsFLDG9oitveYP4kXFFSsGRBr-breiN0UD-LLUpXfAEBKIh-g6NBkjqod9Q6fuswSA6iTRNfIhmY.-fYPJLNys5VCINpc8PSNKNyKFoILkzigmaKBcj3-xMI&dib_tag=se&keywords=jane+mansons&qid=1785166801&s=books&sprefix=jane+mansons%2Cstripbooks-intl-ship%2C507&sr=1-8#detailBullets_feature_div"
                button-label="Read More" />

            <x-site.book-feature label="Book 2" title="Benny Helps Mia See"
                copy="When Mia starts having trouble seeing the chalkboard at school, she feels scared to tell anyone, especially after classmates begin to tease her. But her loyal friend, Benny the red-eared bear, is there to help her find her courage. With Benny’s gentle guidance, Mia learns that asking for help isn’t something to hide; it’s something brave. Benny Helps Mia See is a touching story about confidence, kindness, and the power of friendship."
                image="frontend/assets/images/Group 1171276131.png" image-alt="Benny Helps Mia See book cover"
                :image-width="499" :image-height="622" image-side="right"
                button-href="https://www.amazon.com/Benny-Helps-Mia-Jane-Mansons/dp/B0G29JSC41/ref=sr_1_3?crid=2F085JF3GKWTX&dib=eyJ2IjoiMSJ9.GafRLrtTuX9XUWKGf0_C-NHf6oLhZsispyY0w_vBuRgaelZ6FaieE2AinidZipsb8VHD5tMZaQVGRcL2jOoyFp_mRjRFe2S7bkt1db4ArdlEGg28zWWwdqScy5WZRAXLmc5SdNN4sGIvOaL5hAs5yiZ42tT9lG8LsFLDG9oitveYP4kXFFSsGRBr-breiN0UD-LLUpXfAEBKIh-g6NBkjqod9Q6fuswSA6iTRNfIhmY.-fYPJLNys5VCINpc8PSNKNyKFoILkzigmaKBcj3-xMI&dib_tag=se&keywords=jane+mansons&qid=1785166801&s=books&sprefix=jane+mansons%2Cstripbooks-intl-ship%2C507&sr=1-3"
                button-label="Read More" />

            <x-site.book-feature label="Book 3" title="Benny and the Nighttime Brave"
                copy="Benny and The Night Time Brave is a heartwarming story about courage, confidence, and discovering that being brave doesn't mean you're never afraid. When nighttime may bring unfamiliar sounds and shadows, Benny's encouragement and comfort instill resilience and self-confidence, while making bedtime a comforting and empowering experience."
                image="frontend/assets/images/Group 1171276105_result.webp"
                image-alt="Benny and the Nighttime Brave book cover" :image-width="499" :image-height="622" image-side="left"
                button-href="https://www.amazon.com/BENNY-NIGHTTIME-BRAVE-JANE-MANSONS-ebook/dp/B0H8B5QVHG/ref=sr_1_1?crid=2F085JF3GKWTX&dib=eyJ2IjoiMSJ9.GafRLrtTuX9XUWKGf0_C-NHf6oLhZsispyY0w_vBuRgaelZ6FaieE2AinidZipsb8VHD5tMZaQVGRcL2jOoyFp_mRjRFe2S7bkt1db4ArdlEGg28zWWwdqScy5WZRAXLmc5SdNN4sGIvOaL5hAs5yiZ42tT9lG8LsFLDG9oitveYP4kXFFSsGRBr-breiN0UD-LLUpXfAEBKIh-g6NBkjqod9Q6fuswSA6iTRNfIhmY.-fYPJLNys5VCINpc8PSNKNyKFoILkzigmaKBcj3-xMI&dib_tag=se&keywords=jane+mansons&qid=1785166801&s=books&sprefix=jane+mansons%2Cstripbooks-intl-ship%2C507&sr=1-1"
                button-label="Read More" />
        </div>
    </section>

    <section class="section section--white standards" id="standards">
        <img class="standards__art standards__art--left" src="{{ asset('frontend/assets/images/Mia 1_result.webp') }}"
            alt="" width="337" height="776" loading="lazy" aria-hidden="true">

        <img class="standards__art standards__art--right" src="{{ asset('frontend/assets/images/Sammy 1_result.webp') }}"
            alt="" width="359" height="758" loading="lazy" aria-hidden="true">

        <div class="site-container">
            <div class="standards__heading" data-reveal="fade-up">
                <span class="eyebrow">The Book</span>
                <h2 class="section-heading">Stanzas</h2>
            </div>

            <div class="standards__grid">
                <article class="standard-card" data-reveal="fade-up" style="--reveal-delay: 0.05s">
                    <h3>BOOK 01</h3>
                    <p>BUT WHAT MADE HIM DIFFERENT, THE THING YOU'D SOON SPOT, WAS THE EAR ON HIS RIGHT- IT WAS RED, NOT
                        BROWN... NOT! THE TOYS ON THE SHELF WOULD WHISPER AND STARE, "WHY'S BENNY'S EAR RED? THAT'S JUST NOT
                        QUITE FAIR!</p>
                    <span class="standard-card__page">- Page no 08</span>
                </article>
                <article class="standard-card" data-reveal="fade-up" style="--reveal-delay: 0.12s">
                    <h3>BOOK 01</h3>
                    <p>MIA JUST SMILED, HER EYES BRIGHT AND CLEAR, "BENNY'S STILL BENNY - NO MATTER THE EAR." SO GRANDMA
                        STITCHED GENTLY WITH FINGERS SO KIND, AND GAVE BENNY AN EAR THAT WOULD ALWAYS REMIND...</p>
                    <span class="standard-card__page">- Page no 21</span>
                </article>
                <article class="standard-card" data-reveal="fade-up" style="--reveal-delay: 0.18s">
                    <h3>BOOK 02</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry standard.</p>
                    <span class="standard-card__page">- Page no 00</span>
                </article>
                <article class="standard-card" data-reveal="fade-up" style="--reveal-delay: 0.24s">
                    <h3>BOOK 03</h3>
                    <p>Pebbles was round, with patches so neat, She'd purr and curl at Sammy's feet. Her meow was soft-just
                        a squeaky sound-But her love made Sammy feel safe and sound.</p>
                    <span class="standard-card__page">- Page no 06</span>
                </article>
            </div>

            {{-- <div class="standards__cta" data-reveal="fade-up" style="--reveal-delay: 0.1s">
                <x-site.button href="#books" variant="dark">Read More</x-site.button>
            </div> --}}
        </div>
    </section>

    <section class="section section--ochre section--banner" id="retail">
        <div class="site-container retail__grid">
            <div class="retail__media" data-reveal="fade-right">
                <img src="{{ asset('frontend/assets/images/Group 1171276117_result.webp') }}"
                    alt="Benny books available in stores" width="950" height="641" loading="lazy">
            </div>

            <div class="retail__content" data-reveal="fade-left" style="--reveal-delay: 0.12s">
                <h2 class="retail__title">Available on Amazon and Barnes &amp; Noble</h2>
                <p class="retail__copy">
                    Step into Benny’s world of courage, imagination, and heartwarming adventures. These beautifully
                    illustrated books are perfect for young readers and families to enjoy together. Order your copy today
                    and make every storytime extra special.
                </p>
                <div class="retail__logos">
                    <a class="retail__logo-btn"
                        href="https://www.amazon.com/stores/author/B0FMZWCXY5/allbooks?_encoding=UTF8&ref_=aufs_ap_ahdr_dsk_ab&pd_rd_w=AjYQU&content-id=amzn1.sym.7e190e19-9f6f-4df8-807a-5a7608594741&pf_rd_p=7e190e19-9f6f-4df8-807a-5a7608594741&pf_rd_r=133-0573497-6442602&pd_rd_wg=hv8v4&pd_rd_r=39ac9449-9fe8-41a8-ac96-1fe14a6050c5"
                        aria-label="Available at Amazon" target="_blank">
                        <img src="{{ asset('frontend/assets/images/Group 1171276127_result.webp') }}"
                            alt="Available at Amazon" width="314" height="150" loading="lazy">
                    </a>
                    <a class="retail__logo-btn"
                        href="https://www.barnesandnoble.com/search?attributes.contributorId=32359008&contributorName=Jane%20Mansons"
                        aria-label="Barnes & Noble" target="_blank">
                        <img src="{{ asset('frontend/assets/images/Group 1171276115_result.webp') }}" alt="Barnes & Noble"
                            width="314" height="150" loading="lazy">
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
                <img class="testimonials__deco testimonials__deco--yarn"
                    src="{{ asset('frontend/assets/images/testimonials-yarn.png') }}" alt="" width="160"
                    height="140" loading="lazy" aria-hidden="true">
                <h2 class="section-heading testimonials__title">What Benny's Buddies Say</h2>
                <img class="testimonials__deco testimonials__deco--glasses"
                    src="{{ asset('frontend/assets/images/testimonials-glasses.png') }}" alt="" width="120"
                    height="80" loading="lazy" aria-hidden="true">
            </div>

            <div class="testimonials__video" data-testimonials-video data-reveal="zoom" style="--reveal-delay: 0.1s">
                <video class="testimonials__video-el"
                    poster="{{ asset('frontend/assets/images/Mask group_result.webp') }}" playsinline preload="metadata"
                    controlsList="nodownload">
                    <source src="{{ asset('frontend/assets/videos/testimonials.mp4') }}" type="video/mp4">
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
                <div class="testimonials__slide">
                    <x-site.testimonial name="Amazon Customer" headline="Very Impressive"
                        quote="My girls (both 5), love this book. Very well done and fun with a great message."
                        avatar="frontend/assets/images/Mask group (1)_result.webp" />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial name="Amazon Customer" headline="I Realy Appreciate!!"
                        quote="Such a sweet story! Our 8-year-old loved reading this book aloud to her 2-month-old baby brother, and it was such a special moment watching them enjoy it together. The story is engaging and reflecting, even for older kids. While the rhythm and flow of the words kept the baby calm and happy. A wonderful book for families with kids of different ages—definitely a new favorite in our home!"
                        avatar="frontend/assets/images/Mask group (2)_result.webp" />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial name="Ashley Fedor" headline="Benny and The Red Ear"
                        quote="A sweet, rhyming picture book about Benny the bear, who loses an ear in a summer storm and gets patched up with the only yarn his family has on hand: bright red. What could have been an embarrassing moment turns into something tender instead, as Benny learns that his mismatched ear is what makes him special. My 8 year old really connected with that message, and loved reading it aloud to his little brother, who was completely charmed by the rhymes and the visuals that he could point to on every page. It has quickly become one of our favorite bedtime reads for both kids, and I suspect it will stay in the rotation for a long time."
                        avatar="frontend/assets/images/Mask group (1)_result.webp" />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial name="Ashley Fedor" headline="I Realy Appreciate!!"
                        quote="A heartwarming follow-up to Benny and the Red Ear, this one follows Mia as she struggles to see the chalkboard at school and feels too scared to say anything, especially once classmates start teasing her. Benny, her loyal red-eared bear, gently helps her find the courage to speak up. My 8 year old related to the worry about being teased and loved watching Mia get brave, while my 2 year old just adored seeing Benny again, since he already feels like an old friend from the first book. Such a sweet, reassuring read about how asking for help is actually a brave thing to do, not something to hide. Highly recommend!!"
                        avatar="frontend/assets/images/Mask group (2)_result.webp" />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial name="Alex" headline="Very Impressive"
                        quote="My girls (4 and 2) loved it! Looking forward to book 2!"
                        avatar="frontend/assets/images/Mask group (2)_result.webp" />
                </div>
                <div class="testimonials__slide">
                    <x-site.testimonial name="Dr Laurie Emery " headline="Amazing!!"
                        quote="Benny & The Red Ear gently teaches children that what makes us different is not something to hide, but often the very thing that makes us uniquely lovable. Rather than preaching acceptance, the story allows children to experience it emotionally through Benny’s journey. It opens meaningful conversations about self-worth, resilience, empathy, and belonging, making it a wonderful resource for parents, grandparents, educators, and therapists alike. The warmth of the storytelling reminds children that love isn’t based on perfection—it’s found in being fully ourselves. I highly recommend this beautiful book to every family with young children. "
                        avatar="frontend/assets/images/Mask group (2)_result.webp" />
                </div>
            </div>
        </div>
    </section>

    <section class="section section--ochre" id="contact">
        <div class="site-container contact__grid">
            <div class="contact__media" data-reveal="fade-right">
                <img src="{{ asset('frontend/assets/images/Group 1171276117_result.webp') }}"
                    alt="Shop the Benny book collection" width="950" height="641" loading="lazy">
                <div class="contact__order">
                    <x-site.button href="{{ route('books.index') }}" variant="dark">Order Now</x-site.button>
                </div>
            </div>

            <div class="contact__content" data-reveal="fade-left" style="--reveal-delay: 0.12s">
                <h2 class="contact__title">Benny's Buddies</h2>
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

<header class="site-header">
    <div class="site-container site-header__inner">
        <a class="site-logo" href="{{ url('/') }}" aria-label="Jane Mansons home">
            <img
                src="{{ asset('frontend/assets/images/Jane Mansons_result.webp') }}"
                alt="Jane Mansons"
                width="140"
                height="70"
            >
        </a>

        <button
            class="site-nav-toggle"
            type="button"
            data-nav-toggle
            aria-expanded="false"
            aria-controls="site-nav"
            aria-label="Toggle navigation"
        >
            <span aria-hidden="true">☰</span>
        </button>

        <nav id="site-nav" class="site-nav" data-site-nav aria-label="Primary">
            <a href="#about">Meet the Author</a>
            <a href="#books">The Books</a>
            <a href="#standards">Gallery</a>
            <a href="#trailers">Video Trailers</a>
            <a href="#contact">Contact Us</a>
            <x-site.button href="#retail" variant="dark" class="ms-lg-2">Order Now</x-site.button>
        </nav>
    </div>
</header>

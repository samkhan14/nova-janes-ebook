<header class="site-header">
    <div class="site-container site-header__inner">
        <a class="site-logo" href="{{ url('/') }}" aria-label="Jane Mansons home">
            <img src="{{ asset('frontend/assets/images/Jane Mansons_result.webp') }}" alt="Jane Mansons" width="200"
                height="120">
        </a>

        <button class="site-nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="site-nav"
            aria-label="Toggle navigation">
            <span aria-hidden="true">☰</span>
        </button>

        <nav id="site-nav" class="site-nav" data-site-nav aria-label="Primary">
            <a href="{{ url('/#about') }}">About the Author</a>
            <a href="{{ url('/#testimonials') }}">Testimonial</a>
            <a href="{{ url('/#standards') }}">Benny's Buddies</a>
            {{-- <a href="{{ route('books.index') }}">My Books</a> --}}
            {{-- <a href="{{ url('/#trailers') }}">Video Trailers</a> --}}
        </nav>

        <x-site.button href="#" variant="dark" class="site-nav__cta">Contact Me</x-site.button>
    </div>
</header>

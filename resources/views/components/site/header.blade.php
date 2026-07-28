@php
    $header = $header ?? [];
    $logo = \App\Support\CmsMedia::url($header['logo'] ?? 'frontend/assets/images/Jane-mansons-white-logo.png');
    $navLinks = $header['nav_links'] ?? [];
    $ctaLabel = $header['cta_label'] ?? 'Contact Me';
    $ctaHref = $header['cta_href'] ?? '#contact';
@endphp

<header class="site-header">
    <div class="site-container site-header__inner">
        <a class="site-logo" href="{{ url('/') }}" aria-label="Jane Mansons home">
            <img src="{{ $logo }}" alt="Jane Mansons" width="200"
                height="120">
        </a>

        <button class="site-nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="site-nav"
            aria-label="Toggle navigation">
            <span aria-hidden="true">☰</span>
        </button>

        <nav id="site-nav" class="site-nav" data-site-nav aria-label="Primary">
            @foreach ($navLinks as $link)
                @php
                    $href = $link['url'] ?? '#';
                    $isAbsolute = \Illuminate\Support\Str::startsWith($href, ['http://', 'https://', '//', '#', '/']);
                @endphp
                <a href="{{ $isAbsolute ? $href : url($href) }}">{{ $link['label'] ?? '' }}</a>
            @endforeach
        </nav>

        <x-site.button href="{{ $ctaHref }}" variant="dark" class="site-nav__cta">{{ $ctaLabel }}</x-site.button>
    </div>
</header>

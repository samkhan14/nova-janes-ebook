@props([
    'name',
    'headline',
    'quote',
    'avatar',
    'avatarAlt' => null,
    'websiteUrl' => null,
    'facebookUrl' => null,
    'instagramUrl' => null,
    'threadsUrl' => null,
    'linktreeUrl' => null,
])

@php
    $links = collect([
        'Website' => $websiteUrl,
        'Facebook' => $facebookUrl,
        'Instagram' => $instagramUrl,
        'Threads' => $threadsUrl,
        'Linktree' => $linktreeUrl,
    ])->filter(fn ($url) => filled($url));
@endphp

<article class="testimonial-card">
    <img
        class="testimonial-card__avatar"
        src="{{ \App\Support\CmsMedia::url($avatar) }}"
        alt="{{ $avatarAlt ?? $name }}"
        width="88"
        height="88"
        loading="lazy"
    >

    <p class="testimonial-card__name">{{ $name }}</p>
    <h3 class="testimonial-card__headline">{{ $headline }}</h3>
    <p class="testimonial-card__quote">{{ $quote }}</p>

    @if ($links->isNotEmpty())
        <ul class="testimonial-card__links">
            @foreach ($links as $label => $url)
                <li>
                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">{{ $label }}</a>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="testimonial-card__stars" aria-label="5 out of 5 stars">★★★★★</div>
</article>

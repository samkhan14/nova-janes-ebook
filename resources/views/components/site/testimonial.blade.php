@props([
    'name',
    'role' => null,
    'quote',
    'avatar',
    'avatarAlt' => null,
])

<article class="testimonial-card">
    <img
        class="testimonial-card__avatar"
        src="{{ asset($avatar) }}"
        alt="{{ $avatarAlt ?? $name }}"
        width="88"
        height="88"
        loading="lazy"
    >

    <h3 class="testimonial-card__name">{{ $name }}</h3>

    @if ($role)
        <p class="small text-muted mb-2">{{ $role }}</p>
    @endif

    <p class="testimonial-card__quote">{{ $quote }}</p>
    <div class="testimonial-card__stars" aria-label="5 out of 5 stars">★★★★★</div>
</article>

@props([
    'name',
    'headline',
    'quote',
    'avatar',
    'avatarAlt' => null,
])

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
    <div class="testimonial-card__stars" aria-label="5 out of 5 stars">★★★★★</div>
</article>

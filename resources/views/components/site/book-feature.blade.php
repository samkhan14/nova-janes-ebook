@props([
    'label',
    'title',
    'copy',
    'image',
    'imageAlt',
    'imageWidth' => 391,
    'imageHeight' => 607,
    'imageSide' => 'left',
    'buttonHref' => '#',
    'buttonLabel' => 'Read More',
])

@php
    $isImageRight = $imageSide === 'right';
@endphp

<article @class(['book-feature', 'book-feature--image-right' => $isImageRight])>
    <div class="book-feature__image">
        <img
            src="{{ asset($image) }}"
            alt="{{ $imageAlt }}"
            width="{{ $imageWidth }}"
            height="{{ $imageHeight }}"
            loading="lazy"
        >
    </div>

    <div class="book-feature__content">
        <span class="book-feature__label">{{ $label }}</span>
        <h3 class="book-feature__title">{{ $title }}</h3>
        <p class="book-feature__copy">{{ $copy }}</p>
        <x-site.button :href="$buttonHref" variant="dark">{{ $buttonLabel }}</x-site.button>
    </div>
</article>

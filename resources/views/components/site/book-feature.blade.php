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

<article
    @class(['book-feature', 'book-feature--image-right' => $isImageRight])
    data-reveal="{{ $isImageRight ? 'fade-left' : 'fade-right' }}"
>
    <div class="row align-items-start book-feature__row g-3 g-md-4">
        @if ($isImageRight)
            <div class="col-12 col-md-3" aria-hidden="true"></div>

            <div class="col-12 col-md-6">
                <div class="book-feature__content">
                    <span class="book-feature__label">{{ $label }}</span>
                    <h3 class="book-feature__title">{{ $title }}</h3>
                    <p class="book-feature__copy">{{ $copy }}</p>
                    <x-site.button :href="$buttonHref" variant="dark">{{ $buttonLabel }}</x-site.button>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="book-feature__image">
                    <img
                        src="{{ \App\Support\CmsMedia::url($image) }}"
                        alt="{{ $imageAlt }}"
                        width="{{ $imageWidth }}"
                        height="{{ $imageHeight }}"
                        loading="lazy"
                    >
                </div>
            </div>
        @else
            <div class="col-12 col-md-3">
                <div class="book-feature__image">
                    <img
                        src="{{ \App\Support\CmsMedia::url($image) }}"
                        alt="{{ $imageAlt }}"
                        width="{{ $imageWidth }}"
                        height="{{ $imageHeight }}"
                        loading="lazy"
                    >
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="book-feature__content">
                    <span class="book-feature__label">{{ $label }}</span>
                    <h3 class="book-feature__title">{{ $title }}</h3>
                    <p class="book-feature__copy">{{ $copy }}</p>
                    <x-site.button :href="$buttonHref" variant="dark">{{ $buttonLabel }}</x-site.button>
                </div>
            </div>

            <div class="col-12 col-md-3" aria-hidden="true"></div>
        @endif
    </div>
</article>

@props([
    'label' => null,
    'href' => '#',
    'variant' => 'dark',
])

@php
    $hrefHost = parse_url($href, PHP_URL_HOST);
    $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);
    $isExternal = filled($hrefHost)
        && filled($appHost)
        && strcasecmp((string) $hrefHost, (string) $appHost) !== 0;

    $linkAttributes = $attributes->class(['btn-pill', 'btn-pill--'.$variant]);

    if ($isExternal) {
        $linkAttributes = $linkAttributes->merge([
            'target' => '_blank',
            'rel' => 'noopener noreferrer',
        ]);
    }
@endphp

<a {{ $linkAttributes }} href="{{ $href }}">
    {{ $slot->isEmpty() ? $label : $slot }}
</a>

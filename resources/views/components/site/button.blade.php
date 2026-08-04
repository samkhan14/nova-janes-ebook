@props([
    'label' => null,
    'href' => '#',
    'variant' => 'dark',
])

@php
    $resolvedHref = trim((string) $href);
    $resolvedLower = \Illuminate\Support\Str::lower($resolvedHref);

    if (
        filled($resolvedHref)
        && ! \Illuminate\Support\Str::startsWith($resolvedLower, ['http://', 'https://', '//', 'mailto:', 'tel:', '/', '#'])
        && filter_var($resolvedHref, FILTER_VALIDATE_EMAIL)
    ) {
        $resolvedHref = 'mailto:'.$resolvedHref;
    }

    $hrefHost = parse_url($resolvedHref, PHP_URL_HOST);
    $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);
    $isExternal = filled($hrefHost)
        && filled($appHost)
        && strcasecmp((string) $hrefHost, (string) $appHost) !== 0
        && ! \Illuminate\Support\Str::startsWith($resolvedLower, ['mailto:', 'tel:']);

    $linkAttributes = $attributes->class(['btn-pill', 'btn-pill--'.$variant]);

    if ($isExternal) {
        $linkAttributes = $linkAttributes->merge([
            'target' => '_blank',
            'rel' => 'noopener noreferrer',
        ]);
    }
@endphp

<a {{ $linkAttributes }} href="{{ $resolvedHref }}">
    {{ $slot->isEmpty() ? $label : $slot }}
</a>

@props([
    'label' => null,
    'href' => '#',
    'variant' => 'dark',
])

<a {{ $attributes->class(['btn-pill', 'btn-pill--'.$variant]) }} href="{{ $href }}">
    {{ $slot->isEmpty() ? $label : $slot }}
</a>

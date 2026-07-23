@props([
    'title',
    'class' => null,
])

<h2 {{ $attributes->class(['section-heading', $class]) }}>{{ $title }}</h2>

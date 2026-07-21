@props([
    'src',
    'alt' => '',
    'class' => '',
    'eager' => false,
    'width' => null,
    'height' => null,
])

@php
    $resolvedSrc = str_starts_with($src, 'http://') || str_starts_with($src, 'https://')
        ? $src
        : asset($src);
@endphp

<img
    src="{{ $resolvedSrc }}"
    alt="{{ $alt }}"
    @if ($class) class="{{ $class }}" @endif
    @if ($width) width="{{ $width }}" @endif
    @if ($height) height="{{ $height }}" @endif
    @if ($eager)
        fetchpriority="high"
        decoding="async"
    @else
        loading="lazy"
        decoding="async"
    @endif
>

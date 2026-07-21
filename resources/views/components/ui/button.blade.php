@props([
    'variant' => 'gold',
    'href' => null,
    'type' => 'button',
    'icon' => null,
    'size' => null,
])

@php
    $classes = 'a2z-btn a2z-btn--'.$variant;

    if ($size === 'sm') {
        $classes .= ' a2z-btn--sm';
    }

    if ($size === 'lg') {
        $classes .= ' a2z-btn--lg';
    }
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if ($icon)
            <x-ui.icon :name="$icon" />
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if ($icon)
            <x-ui.icon :name="$icon" />
        @endif
    </button>
@endif

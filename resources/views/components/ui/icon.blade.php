@props([
    'name',
    'size' => null,
    'color' => null,
])

@php
    $classes = 'a2z-icon';

    if ($size === 'sm') {
        $classes .= ' a2z-icon--sm';
    }

    if ($size === 'lg') {
        $classes .= ' a2z-icon--lg';
    }

    if ($color === 'gold') {
        $classes .= ' a2z-icon--gold';
    }

    if ($color === 'teal') {
        $classes .= ' a2z-icon--teal';
    }
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>{{ $name }}</span>

@props(['variant' => 'muted'])

<span {{ $attributes->merge(['class' => 'adm-badge adm-badge--'.$variant]) }}>
    {{ $slot }}
</span>

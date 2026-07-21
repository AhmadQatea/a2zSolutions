@props(['icon', 'label', 'value', 'trend' => null, 'accent' => 'primary'])

<div class="adm-stat adm-stat--{{ $accent }} adm-panel adm-panel--inner-glow">
    <div class="adm-stat__icon">
        <span class="material-symbols-outlined">{{ $icon }}</span>
    </div>
    <div class="adm-stat__body">
        <p class="adm-stat__label">{{ $label }}</p>
        <p class="adm-stat__value">{{ $value }}</p>
        @if ($trend)
            <p class="adm-stat__trend">{{ $trend }}</p>
        @endif
    </div>
</div>

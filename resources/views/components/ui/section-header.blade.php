@props([
    'title',
    'description' => null,
    'centered' => false,
])

<div class="a2z-section-header{{ $centered ? ' a2z-section-header--centered' : '' }}">
    <h2 class="a2z-section-header__title">{{ $title }}</h2>

    @if ($description)
        <p class="a2z-section-header__description">{{ $description }}</p>
    @endif
</div>

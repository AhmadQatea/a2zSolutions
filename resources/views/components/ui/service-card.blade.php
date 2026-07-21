@props([
    'icon',
    'iconVariant' => 'navy',
    'title',
    'description',
    'href' => '#',
])

<div {{ $attributes->merge(['class' => 'a2z-service-card']) }}>
    <div class="a2z-service-card__head">
        <div class="a2z-service-card__icon a2z-service-card__icon--{{ $iconVariant }}">
            <x-ui.icon :name="$icon" />
        </div>
        <h3 class="a2z-service-card__title">{{ $title }}</h3>
    </div>

    <p class="a2z-service-card__description">{{ $description }}</p>

    <a href="{{ $href }}" class="a2z-service-card__link">
        اقرأ المزيد
        <x-ui.icon name="arrow_back" size="sm" />
    </a>
</div>

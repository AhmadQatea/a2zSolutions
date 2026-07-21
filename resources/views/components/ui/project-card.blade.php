@props([
    'image',
    'imageAlt',
    'category',
    'categoryVariant' => 'gold',
    'title',
    'description',
])

<div class="a2z-project-card">
    <x-ui.lazy-img :src="$image" :alt="$imageAlt" class="a2z-project-card__image" />

    <div class="a2z-project-card__overlay">
        <span class="a2z-project-card__category a2z-project-card__category--{{ $categoryVariant }}">{{ $category }}</span>
        <h3 class="a2z-project-card__title">{{ $title }}</h3>
        <p class="a2z-project-card__description">{{ $description }}</p>
    </div>
</div>

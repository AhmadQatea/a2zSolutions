@props([
    'serviceType',
    'image',
    'imageAlt',
    'tags',
    'title',
    'description',
])

<article class="portfolio-card" data-project-card data-category="{{ $serviceType }}">
    <div class="portfolio-card__media">
        <x-ui.lazy-img :src="$image" :alt="$imageAlt" class="portfolio-card__image" />
        <div class="portfolio-card__overlay">
            <span class="portfolio-card__overlay-label">عرض التفاصيل</span>
        </div>
    </div>

    <div class="portfolio-card__body">
        <div class="portfolio-card__tags">
            @foreach ($tags as $tag)
                <span class="portfolio-card__tag">{{ $tag }}</span>
            @endforeach
        </div>

        <h3 class="portfolio-card__title">{{ $title }}</h3>
        <p class="portfolio-card__description">{{ $description }}</p>
    </div>
</article>

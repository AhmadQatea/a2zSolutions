@php($hero = config('site.knowledge_page.hero'))

<section class="knowledge-hero">
    <div class="knowledge-hero__bg" aria-hidden="true"></div>
    <div class="knowledge-hero__overlay" aria-hidden="true"></div>

    <div class="a2z-container knowledge-hero__inner">
        <span class="knowledge-hero__badge">{{ $hero['badge'] }}</span>
        <h1 class="knowledge-hero__title">{{ $hero['title'] }}</h1>
        <p class="knowledge-hero__description">{{ $hero['description'] }}</p>
    </div>
</section>

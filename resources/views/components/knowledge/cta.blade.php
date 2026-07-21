@php($cta = config('site.knowledge_page.cta'))

<section class="knowledge-cta">
    <div class="a2z-container">
        <div class="knowledge-cta__card">
            <div class="knowledge-cta__content">
                <h2 class="knowledge-cta__title">{{ $cta['title'] }}</h2>
                <p class="knowledge-cta__description">{{ $cta['description'] }}</p>
                <x-ui.button variant="gold" size="lg" :href="$cta['href']">
                    {{ $cta['button_label'] }}
                </x-ui.button>
            </div>
        </div>
    </div>
</section>

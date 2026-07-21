@php($cta = config('site.projects_page.cta'))

<section class="projects-cta">
    <div class="a2z-container">
        <div class="projects-cta__card">
            <div class="projects-cta__glow" aria-hidden="true"></div>
            <div class="projects-cta__content">
                <h2 class="projects-cta__title">{{ $cta['title'] }}</h2>
                <p class="projects-cta__description">{{ $cta['description'] }}</p>

                <div class="projects-cta__actions">
                    <x-ui.button variant="gold" size="lg" :href="$cta['primary_href']">
                        {{ $cta['primary_label'] }}
                    </x-ui.button>
                    <x-ui.button variant="outline-teal" size="lg" :href="$cta['secondary_href']">
                        {{ $cta['secondary_label'] }}
                    </x-ui.button>
                </div>
            </div>
        </div>
    </div>
</section>

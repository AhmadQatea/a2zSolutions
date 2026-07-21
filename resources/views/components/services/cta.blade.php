@php($cta = config('site.services_page.cta'))

<section class="services-cta">
    <div class="a2z-container">
        <div class="services-cta__card">
            <div class="services-cta__content">
                <h2 class="services-cta__title">{{ $cta['title'] }}</h2>
                <p class="services-cta__description">{{ $cta['description'] }}</p>

                <x-ui.button variant="gold" size="lg" :href="$cta['href']">
                    {{ $cta['button_label'] }}
                </x-ui.button>
            </div>
        </div>
    </div>
</section>

@php($cta = config('site.contact_page.cta'))

<section class="contact-cta">
    <div class="a2z-container">
        <div class="contact-cta__card">
            <div class="contact-cta__content">
                <h2 class="contact-cta__title">{{ $cta['title'] }}</h2>
                <p class="contact-cta__description">{{ $cta['description'] }}</p>
                <x-ui.button variant="gold" size="lg" :href="$cta['href']">
                    {{ $cta['button_label'] }}
                </x-ui.button>
            </div>
        </div>
    </div>
</section>

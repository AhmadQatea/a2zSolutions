@php($cta = config('site.cta'))

<section id="contact" class="a2z-cta">
    <div class="a2z-container">
        <div class="a2z-cta__box">
            <div class="a2z-cta__content">
                <h2 class="a2z-cta__title">
                    {{ $cta['title'] }}
                    <br>
                    <span class="a2z-cta__title-highlight">{{ $cta['title_highlight'] }}</span>
                </h2>

                <p class="a2z-cta__description">{{ $cta['description'] }}</p>

                <div class="a2z-cta__actions">
                    <x-ui.button variant="cta" size="lg" href="/contact">
                        {{ $cta['button_label'] }}
                    </x-ui.button>
                </div>
            </div>
        </div>
    </div>
</section>

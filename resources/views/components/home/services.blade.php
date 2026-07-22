@php($services = config('site.services'))

<section id="services" class="a2z-services">
    <div class="a2z-container">
        <x-ui.section-header
            :title="$services['title']"
            :description="$services['description']"
            centered
        />

        {{-- Mobile: clean bento grid --}}
        <div class="a2z-services-bento" aria-label="خدماتنا">
            @foreach ($services['items'] as $service)
                <article class="a2z-services-bento__card">
                    <div class="a2z-services-bento__head">
                        <div class="a2z-service-card__icon a2z-service-card__icon--{{ $service['icon_variant'] }}">
                            <x-ui.icon :name="$service['icon']" />
                        </div>
                        <h3 class="a2z-services-bento__title">{{ $service['title'] }}</h3>
                    </div>
                    <p class="a2z-services-bento__desc">{{ $service['description'] }}</p>
                </article>
            @endforeach
        </div>

        {{-- Desktop: 3D slider --}}
        <div class="a2z-services-swiper-wrap">
            <x-ui.services-slider :items="$services['items']" />
        </div>
    </div>
</section>

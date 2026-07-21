@props([
    'items' => [],
])

<div class="a2z-services-swiper" data-services-swiper>
    <div class="a2z-services-swiper__controls">
        <button
            type="button"
            class="a2z-services-swiper__btn"
            data-services-prev
            aria-label="الخدمة السابقة"
        >
            <x-ui.icon name="arrow_forward" />
        </button>

        <button
            type="button"
            class="a2z-services-swiper__btn"
            data-services-next
            aria-label="الخدمة التالية"
        >
            <x-ui.icon name="arrow_back" />
        </button>
    </div>

    <div class="a2z-services-swiper__viewport">
        <div class="a2z-services-swiper__floor" aria-hidden="true"></div>

        <div class="a2z-services-swiper__track" data-services-track>
            @foreach ($items as $index => $service)
                <div
                    class="a2z-services-swiper__slide"
                    data-services-slide
                    data-slide-index="{{ $index }}"
                >
                    <div class="a2z-services-swiper__face">
                        <x-ui.service-card
                            class="a2z-service-card--swiper"
                            :icon="$service['icon']"
                            :icon-variant="$service['icon_variant']"
                            :title="$service['title']"
                            :description="$service['description']"
                        />
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="a2z-services-swiper__pagination" data-services-pagination>
        @foreach ($items as $index => $service)
            <button
                type="button"
                class="a2z-services-swiper__dot"
                data-services-dot="{{ $index }}"
                aria-label="الانتقال إلى {{ $service['title'] }}"
            ></button>
        @endforeach
    </div>
</div>

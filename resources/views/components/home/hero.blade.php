@php($hero = config('site.hero'))

<section class="a2z-hero">
    <div class="a2z-hero__inner">
        <div class="a2z-hero__content">
            <span class="a2z-hero__badge">{{ $hero['badge'] }}</span>

            <h1 class="a2z-hero__title">
                {{ $hero['title'] }}
                <span class="a2z-hero__title-highlight ">{{ $hero['title_highlight'] }}</span>
                {{ $hero['title_suffix'] }}
            </h1>

            <p class="a2z-hero__description ">{{ $hero['description'] }}</p>

            <div class="a2z-hero__actions">
                <x-ui.button variant="gold" href="#services" icon="arrow_back">
                    اكتشف حلولنا
                </x-ui.button>

                <x-ui.button variant="outline" href="#contact">
                    تواصل معنا
                </x-ui.button>
            </div>
        </div>

        <div class="a2z-hero__media">
            <div class="a2z-hero__image-wrap">
                <x-ui.lazy-img
                    :src="$hero['image']"
                    :alt="$hero['image_alt']"
                    class="a2z-hero__image"
                    :eager="true"
                />
                <div class="a2z-hero__image-overlay"></div>
            </div>

            <div class="a2z-hero__stat-card">
                <div class="a2z-hero__stat-inner">
                    <div class="a2z-hero__stat-icon">
                        <x-ui.icon :name="$hero['stat']['icon']" />
                    </div>
                    <div>
                        <div class="a2z-hero__stat-value">{{ $hero['stat']['value'] }}</div>
                        <div class="a2z-hero__stat-label">{{ $hero['stat']['label'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

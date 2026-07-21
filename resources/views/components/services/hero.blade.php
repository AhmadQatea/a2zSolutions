@php($page = config('site.services_page'))

<section class="services-hero">
    <div class="services-hero__glow services-hero__glow--top" aria-hidden="true"></div>
    <div class="services-hero__glow services-hero__glow--bottom" aria-hidden="true"></div>

    <div class="a2z-container services-hero__inner">
        <span class="services-hero__badge">{{ $page['hero']['badge'] }}</span>

        <h1 class="services-hero__title">
            {{ $page['hero']['title'] }}<br>
            {{ $page['hero']['title_line_2'] }}
        </h1>

        <p class="services-hero__description">{{ $page['hero']['description'] }}</p>

        <div class="services-hero__actions">
            <x-ui.button variant="gold" size="lg" :href="$page['hero']['primary_href']">
                {{ $page['hero']['primary_cta'] }}
            </x-ui.button>

            <x-ui.button variant="outline-teal" size="lg" :href="$page['hero']['secondary_href']">
                {{ $page['hero']['secondary_cta'] }}
            </x-ui.button>
        </div>
    </div>
</section>

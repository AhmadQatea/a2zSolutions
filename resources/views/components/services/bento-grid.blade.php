@php($bento = config('site.services_page.bento'))

<section class="services-bento">
    <div class="a2z-container">
        <div class="services-bento__header">
            <h2 class="services-bento__title">{{ $bento['title'] }}</h2>
            <span class="services-bento__accent" aria-hidden="true"></span>
        </div>

        <div class="services-bento__grid">
            @foreach ($bento['items'] as $item)
                <x-ui.bento-card :item="$item" />
            @endforeach
        </div>
    </div>
</section>

@php($section = config('site.why_choose_us'))

<section id="about" class="a2z-why">
    <div class="a2z-container">
        <div class="a2z-why__grid">
            <div class="a2z-why__content">
                <h2 class="a2z-why__title">{{ $section['title'] }}</h2>
                <p class="a2z-why__description">{{ $section['description'] }}</p>

                <div class="a2z-why__features">
                    @foreach ($section['features'] as $feature)
                        <x-ui.feature-item
                            :icon="$feature['icon']"
                            :icon-color="$feature['icon_color']"
                            :title="$feature['title']"
                            :description="$feature['description']"
                        />
                    @endforeach
                </div>
            </div>

            @foreach ($section['stats'] as $stat)
                @if ($stat['type'] === 'large')
                    <div class="a2z-why__stat-large">
                        <x-ui.icon :name="$stat['icon']" color="gold" size="lg" />
                        <div>
                            <div class="a2z-why__stat-large-value">{{ $stat['value'] }}</div>
                            <div class="a2z-why__stat-large-label">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="a2z-why__stats-small">
                @foreach ($section['stats'] as $stat)
                    @if ($stat['type'] === 'small')
                        <div class="a2z-why__stat-small a2z-why__stat-small--{{ $stat['variant'] }}">
                            <div class="a2z-why__stat-small-value a2z-why__stat-small-value--{{ $stat['variant'] }}">
                                {{ $stat['value'] }}
                            </div>
                            <div class="a2z-why__stat-small-label">{{ $stat['label'] }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

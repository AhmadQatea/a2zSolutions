@props([
    'item',
])

@php
    $layout = $item['layout'] ?? 'standard';
    $cardClass = 'bento-card bento-card--'.$layout;
@endphp

<article {{ $attributes->merge(['class' => $cardClass]) }}>
    @if ($layout === 'featured')
        <div class="bento-card__body bento-card__body--featured">
            <div class="bento-card__icon bento-card__icon--{{ $item['icon_variant'] }}">
                <x-ui.icon :name="$item['icon']" />
            </div>

            <div class="bento-card__content">
                <h3 class="bento-card__title">{{ $item['title'] }}</h3>
                <p class="bento-card__description">{{ $item['description'] }}</p>

                @if (! empty($item['features']))
                    <ul class="bento-card__features">
                        @foreach ($item['features'] as $feature)
                            <li class="bento-card__feature">
                                <x-ui.icon name="check_circle" color="teal" size="sm" />
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        @if (! empty($item['decor_icon']))
            <div class="bento-card__decor" aria-hidden="true">
                <x-ui.icon :name="$item['decor_icon']" />
            </div>
        @endif
    @elseif ($layout === 'wide')
        <div class="bento-card__body bento-card__body--wide">
            <div
                class="bento-card__media"
                style="--bento-media: url('{{ $item['image'] }}')"
                role="img"
                aria-label="{{ $item['image_alt'] ?? $item['title'] }}"
            ></div>

            <div class="bento-card__content">
                <div class="bento-card__icon bento-card__icon--{{ $item['icon_variant'] }} bento-card__icon--inline">
                    <x-ui.icon :name="$item['icon']" />
                </div>

                <h3 class="bento-card__title">{{ $item['title'] }}</h3>
                <p class="bento-card__description">{{ $item['description'] }}</p>

                <x-ui.button variant="outline-navy" :href="$item['href'] ?? '#'">
                    {{ $item['button_label'] ?? 'اقرأ المزيد' }}
                </x-ui.button>
            </div>
        </div>
    @else
        <div class="bento-card__icon bento-card__icon--{{ $item['icon_variant'] }}">
            <x-ui.icon :name="$item['icon']" />
        </div>

        <h3 class="bento-card__title">{{ $item['title'] }}</h3>
        <p class="bento-card__description">{{ $item['description'] }}</p>

        @if (! empty($item['link_label']))
            <a href="{{ $item['href'] ?? '#' }}" class="bento-card__link">
                {{ $item['link_label'] }}
                <x-ui.icon name="arrow_back" size="sm" />
            </a>
        @endif
    @endif
</article>

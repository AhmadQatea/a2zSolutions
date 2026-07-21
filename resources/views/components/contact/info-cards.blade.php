@php($cards = config('site.contact_page.info_cards'))

<section class="contact-info">
    <div class="a2z-container">
        <div class="contact-info__grid">
            @foreach ($cards as $card)
                <a
                    href="{{ $card['href'] }}"
                    class="contact-info__card contact-info__card--{{ $card['border'] }}"
                    @if (! empty($card['external']))
                        target="_blank"
                        rel="noopener noreferrer"
                    @endif
                >
                    <span class="contact-info__icon contact-info__icon--{{ $card['icon_variant'] }}">
                        <x-ui.icon :name="$card['icon']" />
                    </span>
                    <h3 class="contact-info__title">{{ $card['title'] }}</h3>
                    <p class="contact-info__value" @if ($card['icon'] === 'chat') dir="ltr" @endif>{{ $card['value'] }}</p>
                    <p class="contact-info__note">{{ $card['note'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

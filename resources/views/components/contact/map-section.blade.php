@php
    $map = config('site.contact_page.map');
    $coords = config('site.contact.coordinates');
    $mapsUrl = 'https://www.google.com/maps?q='.$coords['lat'].','.$coords['lng'];
    $embedUrl = 'https://maps.google.com/maps?q='.$coords['lat'].','.$coords['lng'].'&z=14&output=embed';
@endphp

<section class="contact-map">
    <div class="contact-map__frame">
        <iframe
            class="contact-map__iframe"
            src="{{ $embedUrl }}"
            title="موقع A2Z Solutions على الخريطة"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen
        ></iframe>
    </div>

    <div class="contact-map__card">
        <h3 class="contact-map__title">{{ $map['title'] }}</h3>
        <p class="contact-map__description">{{ $map['description'] }}</p>

        <div class="contact-map__hours">
            <x-ui.icon name="schedule" color="teal" />
            <div>
                <p class="contact-map__hours-label">{{ $map['hours_label'] }}</p>
                <p class="contact-map__hours-value">{{ $map['hours'] }}</p>
            </div>
        </div>

        <x-ui.button variant="outline-teal" :href="$mapsUrl" icon="map" target="_blank">
            {{ $map['button_label'] }}
        </x-ui.button>
    </div>
</section>

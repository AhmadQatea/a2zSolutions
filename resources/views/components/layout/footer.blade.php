@php
    $contact = config('site.contact');
    $mapsUrl = 'https://www.google.com/maps?q='.$contact['coordinates']['lat'].','.$contact['coordinates']['lng'];
    $whatsappUrl = 'https://wa.me/'.$contact['whatsapp'];
@endphp

<footer id="contact" class="a2z-footer" dir="rtl">
    <div class="a2z-footer__grid">
        <div class="a2z-footer__col a2z-footer__col--brand">
            <x-ui.brand-name class="a2z-footer__brand" />
            <p class="a2z-footer__tagline">{{ config('site.tagline') }}</p>
        </div>

        <div class="a2z-footer__col">
            <h4 class="a2z-footer__title">الروابط السريعة</h4>
            <ul class="a2z-footer__links">
                @foreach (config('site.navigation') as $item)
                    <li>
                        <a href="{{ $item['href'] }}" class="a2z-footer__link">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="a2z-footer__col">
            <h4 class="a2z-footer__title">تواصل معنا</h4>
            <ul class="a2z-footer__links">
                <li>
                    <a href="mailto:{{ $contact['email'] }}" class="a2z-footer__contact-item">
                        <x-ui.icon name="mail" size="sm" />
                        <span>{{ $contact['email'] }}</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ $whatsappUrl }}"
                        class="a2z-footer__contact-item"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <x-ui.icon name="chat" size="sm" />
                        <span class="a2z-footer__phone" dir="ltr">{{ $contact['phone'] }}</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ $mapsUrl }}"
                        class="a2z-footer__contact-item"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <x-ui.icon name="location_on" size="sm" />
                        <span>{{ $contact['location'] }}</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="a2z-footer__col">
            <h4 class="a2z-footer__title">تابعنا</h4>
            <div class="a2z-footer__social">
                @foreach (config('site.social') as $social)
                    <a
                        href="{{ $social['href'] }}"
                        class="a2z-footer__social-link"
                        aria-label="{{ $social['label'] }}"
                        @if (str_starts_with($social['href'], 'http'))
                            target="_blank"
                            rel="noopener noreferrer"
                        @endif
                    >
                        <span class="a2z-footer__social-tooltip">{{ $social['label'] }}</span>
                        <x-ui.icon :name="$social['icon']" />
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="a2z-footer__bottom">
        <span class="a2z-footer__copyright">
            &copy; {{ date('Y') }} {{ config('site.name') }}. جميع الحقوق محفوظة.
        </span>

        <div class="a2z-footer__legal">
            @foreach (config('site.legal_links') as $link)
                <a href="{{ $link['href'] }}" class="a2z-footer__link">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</footer>

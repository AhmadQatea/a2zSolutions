<header data-site-header class="a2z-header">
    <div class="a2z-header__inner">
        <a href="{{ route('home') }}" class="a2z-header__brand">
            <x-ui.brand-name />
        </a>

        <nav class="a2z-header__nav" aria-label="التنقل الرئيسي">
            @foreach (config('site.navigation') as $item)
                @php
                    $isActive = isset($item['route']) && $item['route'] && request()->routeIs($item['route']);
                @endphp
                <a
                    href="{{ $item['href'] }}"
                    class="a2z-header__nav-link{{ $isActive ? ' a2z-header__nav-link--active' : '' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="a2z-header__actions">
            <x-ui.button variant="navy" size="sm" class="a2z-header__cta">
                ابدأ الآن
            </x-ui.button>

            <button
                type="button"
                class="a2z-header__toggle"
                data-mobile-nav-toggle
                aria-expanded="false"
                aria-controls="mobile-nav"
                aria-label="فتح القائمة"
            >
                <span class="a2z-header__toggle-lines" aria-hidden="true">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>
    </div>
</header>

<div
    id="mobile-nav"
    class="a2z-mobile-nav"
    data-mobile-nav
    aria-hidden="true"
>
    <button
        type="button"
        class="a2z-mobile-nav__backdrop"
        data-mobile-nav-close
        aria-label="إغلاق القائمة"
    ></button>

    <nav class="a2z-mobile-nav__panel" aria-label="قائمة الجوال">
        <div class="a2z-mobile-nav__header">
            <span class="a2z-mobile-nav__brand">
                <x-ui.brand-name />
            </span>

            <button
                type="button"
                class="a2z-mobile-nav__close"
                data-mobile-nav-close
                aria-label="إغلاق القائمة"
            >
                <x-ui.icon name="close" />
            </button>
        </div>

        <ul class="a2z-mobile-nav__links">
            @foreach (config('site.navigation') as $item)
                @php
                    $isActive = isset($item['route']) && $item['route'] && request()->routeIs($item['route']);
                @endphp
                <li class="a2z-mobile-nav__item">
                    <a
                        href="{{ $item['href'] }}"
                        class="a2z-mobile-nav__link{{ $isActive ? ' a2z-mobile-nav__link--active' : '' }}"
                        data-mobile-nav-close
                    >
                        <span class="a2z-mobile-nav__link-text">{{ $item['label'] }}</span>
                        <x-ui.icon name="arrow_back" size="sm" />
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="a2z-mobile-nav__footer">
            <x-ui.button variant="gold" href="#contact" class="a2z-mobile-nav__cta" data-mobile-nav-close>
                ابدأ الآن
            </x-ui.button>
        </div>
    </nav>
</div>

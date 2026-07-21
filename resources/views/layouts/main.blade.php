<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    @include('layouts.partials.head')
</head>
<body class="a2z-body">
    <div class="a2z-scroll-progress" data-scroll-progress aria-hidden="true">
        <div class="a2z-scroll-progress__bar" data-scroll-progress-bar></div>
    </div>

    @hasSection('without_header')
    @else
        <x-layout.header />
    @endif

    <main class="a2z-main @yield('main_class', 'a2z-main--offset')">
        @hasSection('full_width')
            @hasSection('without_flash')
            @else
                <div class="a2z-container--flash">
                    <x-layout.flash-messages />
                </div>
            @endif

            @yield('content')
        @else
            <div class="a2z-container a2z-container--padded">
                @hasSection('without_flash')
                @else
                    <x-layout.flash-messages />
                @endif

                @yield('content')
            </div>
        @endif
    </main>

    @hasSection('without_footer')
    @else
        <x-layout.footer />
    @endif

    @include('layouts.partials.scripts')
</body>
</html>

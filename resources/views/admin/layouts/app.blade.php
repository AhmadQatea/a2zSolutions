<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') — {{ config('admin.brand.cms_name') }}</title>
    <link rel="icon" href="{{ asset(config('admin.brand.logo')) }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset(config('admin.brand.logo')) }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/admin/main.css') }}">
    @stack('styles')
</head>
<body class="adm-body">
    <div class="adm-scroll-progress" data-adm-scroll-progress aria-hidden="true">
        <div class="adm-scroll-progress__bar" data-adm-scroll-progress-bar></div>
    </div>

    <div class="adm-shell" data-adm-shell>
        <x-admin.sidebar :active="View::yieldContent('active_nav')" />

        <button
            type="button"
            class="adm-sidebar-toggle"
            data-adm-sidebar-toggle
            aria-label="فتح وإغلاق القائمة"
            aria-expanded="true"
        >
            <span class="material-symbols-outlined" data-adm-sidebar-toggle-icon>menu_open</span>
        </button>

        <div class="adm-main">
            <x-admin.topbar :title="View::yieldContent('page_title')" :description="View::yieldContent('page_description')" />

            <div class="adm-content adm-scrollbar adm-page" data-adm-page>
                <x-admin.page-skeleton />

                <div class="adm-page__body" data-adm-page-body>
                @if ($errors->any())
                    <div class="adm-alert adm-alert--error">
                        <span class="material-symbols-outlined">error</span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="adm-alert adm-alert--success">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/admin/main.js') }}" defer></script>
    @stack('scripts')
</body>
</html>

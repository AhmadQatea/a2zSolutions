<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تسجيل الدخول — {{ config('admin.brand.cms_name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/admin/main.css') }}">
</head>
<body class="adm-body adm-body--auth">
    <div class="adm-auth">
        <div class="adm-auth__bg" style="background-image: url('{{ asset(config('admin.brand.pattern')) }}');"></div>
        <div class="adm-auth__overlay"></div>

        <div class="adm-auth__card adm-panel adm-panel--glow">
            <div class="adm-auth__brand">
                <img src="{{ asset(config('admin.brand.logo')) }}" alt="{{ config('admin.brand.company') }}" class="adm-auth__logo">
                <p class="adm-auth__tagline">{{ config('admin.brand.tagline') }}</p>
            </div>

            <h1 class="adm-auth__title">تسجيل الدخول</h1>
            <p class="adm-auth__subtitle">لوحة إدارة {{ config('admin.brand.company') }}</p>

            @if ($errors->any())
                <div class="adm-alert adm-alert--error">
                    <span class="material-symbols-outlined">error</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="adm-auth__form">
                @csrf

                <label class="adm-field">
                    <span class="adm-field__label">البريد الإلكتروني</span>
                    <div class="adm-field__input-wrap">
                        <span class="material-symbols-outlined">mail</span>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="a2zsolutions@admin.com"
                            required
                            autocomplete="username"
                            class="adm-field__input"
                        >
                    </div>
                </label>

                <label class="adm-field">
                    <span class="adm-field__label">كلمة المرور</span>
                    <div class="adm-field__input-wrap adm-field__input-wrap--password">
                        <span class="material-symbols-outlined">lock</span>
                        <input
                            type="password"
                            name="password"
                            id="admin-password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                            class="adm-field__input"
                            data-adm-password-input
                        >
                        <button
                            type="button"
                            class="adm-password-toggle"
                            data-adm-password-toggle
                            aria-label="إظهار كلمة المرور"
                            aria-pressed="false"
                        >
                            <span class="material-symbols-outlined" data-adm-password-icon>visibility</span>
                        </button>
                    </div>
                </label>

                <button type="submit" class="adm-btn adm-btn--gold adm-btn--full">
                    <span class="material-symbols-outlined">login</span>
                    دخول لوحة التحكم
                </button>
            </form>

            <a href="{{ url('/') }}" class="adm-auth__back">
                <span class="material-symbols-outlined">arrow_back</span>
                العودة للموقع
            </a>
        </div>
    </div>

    <script src="{{ asset('assets/js/admin/auth.js') }}" defer></script>
</body>
</html>

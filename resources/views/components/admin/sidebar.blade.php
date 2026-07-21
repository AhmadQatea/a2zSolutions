@props(['active' => ''])

@php
    $user = session('admin_user', config('admin.user'));
@endphp

<aside class="adm-sidebar">
    <div class="adm-sidebar__brand">
        <div class="adm-sidebar__logo-wrap">
            <img src="{{ asset(config('admin.brand.logo')) }}" alt="{{ config('admin.brand.company') }}" class="adm-sidebar__logo">
        </div>
        <div>
            <h1 class="adm-sidebar__cms">{{ config('admin.brand.cms_name') }}</h1>
            <p class="adm-sidebar__company">{{ config('admin.brand.company') }}</p>
        </div>
    </div>

    <nav class="adm-sidebar__nav adm-scrollbar">
        @foreach (config('admin.navigation') as $item)
            <a
                href="{{ route($item['route']) }}"
                class="adm-sidebar__link {{ $active === $item['route'] ? 'adm-sidebar__link--active' : '' }}"
            >
                <span class="material-symbols-outlined" @if($active === $item['route']) style="font-variation-settings: 'FILL' 1;" @endif>{{ $item['icon'] }}</span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="adm-sidebar__footer">
        <div class="adm-sidebar__user">
            <div class="adm-sidebar__avatar">{{ $user['avatar_initials'] }}</div>
            <div class="adm-sidebar__user-info">
                <p class="adm-sidebar__user-name">{{ $user['name'] }}</p>
                <p class="adm-sidebar__user-role">{{ $user['role'] }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.logout') }}" class="adm-sidebar__logout">
            @csrf
            <button type="submit" class="adm-btn adm-btn--ghost adm-btn--sm adm-btn--full">
                <span class="material-symbols-outlined">logout</span>
                تسجيل الخروج
            </button>
        </form>
    </div>
</aside>

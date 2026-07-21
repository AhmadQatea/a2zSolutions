@props(['title' => '', 'description' => ''])

<header class="adm-topbar">
    <div class="adm-topbar__info">
        @if ($title)
            <h2 class="adm-topbar__title">{{ $title }}</h2>
        @endif
        @if ($description)
            <p class="adm-topbar__desc">{{ $description }}</p>
        @endif
    </div>

    <div class="adm-topbar__actions">
        <a href="{{ url('/') }}" class="adm-btn adm-btn--outline adm-btn--sm" target="_blank" rel="noopener">
            <span class="material-symbols-outlined">open_in_new</span>
            عرض الموقع
        </a>
    </div>
</header>

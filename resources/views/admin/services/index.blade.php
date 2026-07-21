@extends('admin.layouts.app')

@section('title', 'إدارة الخدمات')
@section('active_nav', 'admin.services')
@section('page_title', config('admin.services.title'))
@section('page_description', config('admin.services.description'))

@section('content')
    <div class="adm-mini-stats">
        @foreach ($stats as $stat)
            <div class="adm-mini-stat adm-panel adm-panel--inner-glow">
                <span class="adm-mini-stat__label">{{ $stat['label'] }}</span>
                <strong class="adm-mini-stat__value">{{ $stat['value'] }}</strong>
            </div>
        @endforeach
    </div>

    <div class="adm-toolbar">
        <div class="adm-search">
            <span class="material-symbols-outlined">search</span>
            <input type="search" placeholder="بحث في الخدمات..." class="adm-search__input" data-adm-search="services">
        </div>
        <button type="button" class="adm-btn adm-btn--gold adm-btn--sm">
            <span class="material-symbols-outlined">add</span>
            إضافة خدمة
        </button>
    </div>

    <div class="adm-services-grid" data-adm-list="services">
        @foreach ($services as $service)
            <article class="adm-service-card adm-panel adm-panel--inner-glow" data-adm-searchable="{{ $service['title'] }}">
                <div class="adm-service-card__head">
                    <div class="adm-icon adm-icon--{{ $service['icon_variant'] }}">
                        <span class="material-symbols-outlined">{{ $service['icon'] }}</span>
                    </div>
                    <x-admin.status-badge :variant="$service['is_published'] ? 'success' : 'muted'">
                        {{ $service['is_published'] ? 'منشور' : 'مسودة' }}
                    </x-admin.status-badge>
                </div>

                <h3 class="adm-service-card__title">{{ $service['title'] }}</h3>
                <p class="adm-service-card__desc">{{ $service['description'] }}</p>

                <div class="adm-service-card__actions">
                    <button type="button" class="adm-btn adm-btn--ghost adm-btn--sm">
                        <span class="material-symbols-outlined">edit</span>
                        تعديل
                    </button>
                    <a href="{{ route('services') }}" class="adm-btn adm-btn--ghost adm-btn--sm" target="_blank">
                        <span class="material-symbols-outlined">visibility</span>
                        معاينة
                    </a>
                </div>
            </article>
        @endforeach
    </div>
@endsection

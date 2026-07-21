@extends('admin.layouts.app')

@section('title', 'السياسات والشروط')
@section('active_nav', 'admin.legal')
@section('page_title', config('admin.legal.title'))
@section('page_description', config('admin.legal.description'))

@section('content')
    <div class="adm-legal-tabs adm-filters" data-adm-legal-tabs>
        @foreach ($pages as $index => $page)
            <button
                type="button"
                class="adm-filter {{ $index === 0 ? 'adm-filter--active' : '' }}"
                data-adm-legal-tab="{{ $page['slug'] }}"
            >
                {{ $page['title'] }}
            </button>
        @endforeach
    </div>

    @foreach ($pages as $index => $page)
        <section
            class="adm-legal-editor adm-panel adm-panel--inner-glow"
            data-adm-legal-panel="{{ $page['slug'] }}"
            @if($index !== 0) hidden @endif
        >
            <div class="adm-panel__header">
                <div>
                    <h3 class="adm-panel__title">{{ $page['title'] }}</h3>
                    <span class="adm-panel__subtitle">آخر تحديث: {{ $page['updated_at'] }}</span>
                </div>
                <a href="{{ route('legal.show', $page['slug']) }}" class="adm-btn adm-btn--outline adm-btn--sm" target="_blank">
                    <span class="material-symbols-outlined">visibility</span>
                    معاينة
                </a>
            </div>

            <label class="adm-field adm-field--full">
                <span class="adm-field__label">العنوان</span>
                <input type="text" class="adm-field__input adm-field__input--standalone" value="{{ $page['title'] }}" readonly>
            </label>

            <label class="adm-field adm-field--full">
                <span class="adm-field__label">المحتوى</span>
                <textarea class="adm-field__input adm-field__input--standalone adm-field__textarea adm-field__textarea--lg" rows="10" readonly>{{ $page['content'] }}</textarea>
            </label>
        </section>
    @endforeach
@endsection

@extends('admin.layouts.app')

@section('title', 'إدارة المشاريع')
@section('active_nav', 'admin.projects')
@section('page_title', config('admin.projects.title'))
@section('page_description', config('admin.projects.description'))

@section('content')
    <div class="adm-projects-header adm-panel adm-panel--inner-glow">
        <div class="adm-projects-header__stats">
            <div>
                <span>إجمالي المشاريع</span>
                <strong>{{ count($projects) }}</strong>
            </div>
            <div>
                <span>مميزة للرئيسية</span>
                <strong class="adm-text-gold">{{ $featuredCount }}/{{ $featuredLimit }}</strong>
            </div>
            <div>
                <span>معدل الإنجاز</span>
                <strong class="adm-text-gold">{{ config('admin.projects.completion_rate') }}</strong>
                <small>{{ config('admin.projects.completion_trend') }}</small>
            </div>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="adm-btn adm-btn--gold adm-btn--sm">
            <span class="material-symbols-outlined">add</span>
            مشروع جديد
        </a>
    </div>

    <div class="adm-filters" data-adm-filters>
        @foreach (config('site.projects_page.filters') as $filter)
            <button
                type="button"
                class="adm-filter {{ $filter['slug'] === 'all' ? 'adm-filter--active' : '' }}"
                data-adm-filter="{{ $filter['slug'] }}"
            >
                {{ $filter['label'] }}
            </button>
        @endforeach
    </div>

    <div class="adm-projects-grid" data-adm-list="projects">
        @foreach ($projects as $project)
            @php($isFeatured = $project['featured'] ?? false)
            <article
                class="adm-project-card adm-panel adm-panel--inner-glow"
                data-adm-filterable="{{ $project['service_type'] }}"
                data-adm-project-card
            >
                <div class="adm-project-card__image">
                    <x-ui.lazy-img :src="$project['image']" :alt="$project['image_alt']" />
                    <x-admin.status-badge variant="primary">{{ $filterLabels[$project['service_type']] ?? $project['service_type'] }}</x-admin.status-badge>
                    <x-admin.status-badge
                        variant="gold"
                        class="adm-featured-badge"
                        data-adm-featured-badge
                        :hidden="! $isFeatured"
                    >مميز</x-admin.status-badge>
                </div>

                <div class="adm-project-card__body">
                    <div class="adm-project-card__tags">
                        @foreach ($project['tags'] as $tag)
                            <span class="adm-tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <h3>{{ $project['title'] }}</h3>
                    <p>{{ $project['description'] }}</p>

                    <div class="adm-project-card__actions">
                        <button
                            type="button"
                            class="adm-featured-toggle {{ $isFeatured ? 'is-active' : '' }}"
                            data-adm-featured-toggle
                            aria-pressed="{{ $isFeatured ? 'true' : 'false' }}"
                            title="عرض في الصفحة الرئيسية"
                        >
                            <span class="material-symbols-outlined">star</span>
                            <span data-adm-featured-label>{{ $isFeatured ? 'مميز' : 'تمييز' }}</span>
                        </button>
                        <a href="{{ route('admin.projects.edit', $project['id']) }}" class="adm-btn adm-btn--ghost adm-btn--sm">
                            <span class="material-symbols-outlined">edit</span>
                            تعديل
                        </a>
                        <a href="{{ route('admin.case-studies') }}" class="adm-btn adm-btn--ghost adm-btn--sm">
                            <span class="material-symbols-outlined">analytics</span>
                            دراسة حالة
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection

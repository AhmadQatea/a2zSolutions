@extends('admin.layouts.app')

@section('title', 'إدارة المدونة')
@section('active_nav', 'admin.blog')
@section('page_title', config('admin.blog.title'))
@section('page_description', config('admin.blog.description'))

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
            <input type="search" placeholder="بحث في المقالات..." class="adm-search__input" data-adm-search="blog">
        </div>
        <button type="button" class="adm-btn adm-btn--gold adm-btn--sm">
            <span class="material-symbols-outlined">add</span>
            مقال جديد
        </button>
    </div>

    <div class="adm-blog-list" data-adm-list="blog">
        @foreach ($posts as $post)
            <article class="adm-blog-card adm-panel adm-panel--inner-glow" data-adm-searchable="{{ $post['title'] }}">
                <div class="adm-blog-card__image">
                    <x-ui.lazy-img :src="$post['image']" :alt="$post['image_alt']" />
                </div>
                <div class="adm-blog-card__body">
                    <div class="adm-blog-card__meta">
                        <x-admin.status-badge variant="primary">{{ $post['category'] }}</x-admin.status-badge>
                        <span>{{ $post['date'] }}</span>
                        <span>{{ $post['read_time'] }}</span>
                        <x-admin.status-badge :variant="$post['status_variant']">{{ $post['status'] }}</x-admin.status-badge>
                    </div>
                    <h3>{{ $post['title'] }}</h3>
                    <p>{{ $post['excerpt'] }}</p>
                    <div class="adm-blog-card__actions">
                        <button type="button" class="adm-btn adm-btn--ghost adm-btn--sm">
                            <span class="material-symbols-outlined">edit</span>
                            تعديل
                        </button>
                        <a href="{{ route('knowledge') }}#blog" class="adm-btn adm-btn--ghost adm-btn--sm" target="_blank">
                            <span class="material-symbols-outlined">visibility</span>
                            معاينة
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <section class="adm-panel adm-panel--inner-glow adm-tutorials">
        <div class="adm-panel__header">
            <h3 class="adm-panel__title">أدلة التعليمات</h3>
            <span class="adm-panel__subtitle">{{ config('site.knowledge_page.tutorials.description') }}</span>
        </div>

        <div class="adm-tutorials-grid">
            @foreach ($tutorials as $tutorial)
                <div class="adm-tutorial-card">
                    <div class="adm-icon adm-icon--teal">
                        <span class="material-symbols-outlined">{{ $tutorial['icon'] }}</span>
                    </div>
                    <h4>{{ $tutorial['title'] }}</h4>
                    <p>{{ $tutorial['excerpt'] }}</p>
                    <div class="adm-tutorial-card__meta">
                        <x-admin.status-badge variant="muted">{{ $tutorial['level'] }}</x-admin.status-badge>
                        <span>{{ $tutorial['duration'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

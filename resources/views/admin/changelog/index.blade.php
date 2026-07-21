@extends('admin.layouts.app')

@section('title', 'سجل التغييرات')
@section('active_nav', 'admin.changelog')
@section('page_title', config('admin.changelog.title'))
@section('page_description', config('admin.changelog.description'))

@section('content')
    <div class="adm-toolbar">
        <a href="{{ route('admin.changelog.create') }}" class="adm-btn adm-btn--gold adm-btn--sm">
            <span class="material-symbols-outlined">add</span>
            إضافة تحديث
        </a>
    </div>

    <div class="adm-changelog">
        @foreach ($items as $item)
            <article class="adm-changelog-item adm-panel adm-panel--inner-glow">
                <div class="adm-changelog-item__head">
                    <div class="adm-changelog-item__version">
                        <x-admin.status-badge :variant="match($item['type']) {
                            'release' => 'gold',
                            'feature' => 'primary',
                            'improvement' => 'success',
                            default => 'muted',
                        }">
                            {{ $item['version'] }}
                        </x-admin.status-badge>
                        <span class="adm-changelog-item__type">{{ match($item['type']) {
                            'release' => 'إصدار',
                            'feature' => 'ميزة',
                            'improvement' => 'تحسين',
                            default => $item['type'],
                        } }}</span>
                    </div>
                    <time>{{ $item['date'] }}</time>
                </div>

                <h3>{{ $item['title'] }}</h3>
                <p>{{ $item['description'] }}</p>

                <div class="adm-changelog-item__footer">
                    <span><span class="material-symbols-outlined">person</span> {{ $item['author'] }}</span>
                    @if (isset($item['id']))
                        <a href="{{ route('admin.changelog.edit', $item['id']) }}" class="adm-btn adm-btn--ghost adm-btn--sm">
                            <span class="material-symbols-outlined">edit</span>
                            تعديل
                        </a>
                    @endif
                </div>
            </article>
        @endforeach
    </div>
@endsection

@extends('admin.layouts.app')

@section('title', 'رسائل المستخدمين')
@section('active_nav', 'admin.communications')
@section('page_title', config('admin.communications.title'))
@section('page_description', config('admin.communications.description'))

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
            <input type="search" placeholder="بحث في الرسائل..." class="adm-search__input" data-adm-search="messages">
        </div>
        <button type="button" class="adm-btn adm-btn--outline adm-btn--sm">
            <span class="material-symbols-outlined">download</span>
            تصدير
        </button>
    </div>

    <div class="adm-messages-list" data-adm-list="messages">
        @forelse ($messages as $message)
            <article
                class="adm-message-card adm-panel adm-panel--inner-glow"
                data-adm-searchable="{{ $message['name'] }} {{ $message['email'] }} {{ $message['project_type'] }}"
            >
                <div class="adm-message-card__head">
                    <div class="adm-message-card__sender">
                        <div class="adm-sidebar__avatar">{{ mb_substr($message['name'], 0, 1) }}</div>
                        <div>
                            <strong>{{ $message['name'] }}</strong>
                            <span>{{ $message['email'] }}</span>
                        </div>
                    </div>
                    <x-admin.status-badge :variant="$message['status_variant']">{{ $message['status'] }}</x-admin.status-badge>
                </div>

                <div class="adm-message-card__meta">
                    <span><span class="material-symbols-outlined">call</span> {{ $message['phone'] }}</span>
                    <span><span class="material-symbols-outlined">category</span> {{ $message['project_type'] }}</span>
                    <span><span class="material-symbols-outlined">schedule</span> {{ $message['date'] }}</span>
                </div>

                <p class="adm-message-card__body">{{ $message['message'] }}</p>

                <div class="adm-message-card__actions">
                    <button type="button" class="adm-btn adm-btn--ghost adm-btn--sm">
                        <span class="material-symbols-outlined">reply</span>
                        رد
                    </button>
                    <button type="button" class="adm-btn adm-btn--ghost adm-btn--sm">
                        <span class="material-symbols-outlined">archive</span>
                        أرشفة
                    </button>
                    <a href="mailto:{{ $message['email'] }}" class="adm-btn adm-btn--ghost adm-btn--sm">
                        <span class="material-symbols-outlined">mail</span>
                        بريد
                    </a>
                </div>
            </article>
        @empty
            <p>لا توجد رسائل واردة بعد.</p>
        @endforelse
    </div>
@endsection

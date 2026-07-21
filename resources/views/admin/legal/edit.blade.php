@extends('admin.layouts.app')

@section('title', 'تعديل صفحة قانونية')
@section('active_nav', 'admin.legal')
@section('page_title', 'تعديل الصفحة')
@section('page_description', $page->title)

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <div class="adm-form-actions">
            <a href="{{ route('legal.show', $page->slug) }}" class="adm-btn adm-btn--outline adm-btn--sm" target="_blank">
                <span class="material-symbols-outlined">visibility</span>
                معاينة
            </a>
        </div>

        <form method="POST" action="{{ route('admin.legal.update', $page) }}">
            @csrf
            @method('PUT')

            @include('admin.legal._form', ['page' => $page])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ التعديلات
                </button>
                <a href="{{ route('admin.legal') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>
    </div>
@endsection

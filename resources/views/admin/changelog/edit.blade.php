@extends('admin.layouts.app')

@section('title', 'تعديل سجل تحديث')
@section('active_nav', 'admin.changelog')
@section('page_title', 'تعديل السجل')
@section('page_description', $entry->title)

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.changelog.update', $entry) }}">
            @csrf
            @method('PUT')

            @include('admin.changelog._form', ['entry' => $entry])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ التعديلات
                </button>
                <a href="{{ route('admin.changelog') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.changelog.destroy', $entry) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا السجل؟');">
            @csrf
            @method('DELETE')
            <button type="submit" class="adm-btn adm-btn--ghost adm-btn--sm">
                <span class="material-symbols-outlined">delete</span>
                حذف السجل
            </button>
        </form>
    </div>
@endsection

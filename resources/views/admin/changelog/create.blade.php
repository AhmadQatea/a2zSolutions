@extends('admin.layouts.app')

@section('title', 'إضافة تحديث')
@section('active_nav', 'admin.changelog')
@section('page_title', 'إضافة تحديث جديد')
@section('page_description', 'وثّق تحديثاً أو إصداراً جديداً في السجل.')

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.changelog.store') }}">
            @csrf

            @include('admin.changelog._form', ['entry' => $entry])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ التحديث
                </button>
                <a href="{{ route('admin.changelog') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>
    </div>
@endsection

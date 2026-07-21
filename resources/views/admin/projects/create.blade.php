@extends('admin.layouts.app')

@section('title', 'إضافة مشروع')
@section('active_nav', 'admin.projects')
@section('page_title', 'إضافة مشروع جديد')
@section('page_description', 'أدخل بيانات المشروع الجديد لعرضه في الموقع.')

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.projects.store') }}">
            @csrf

            @include('admin.projects._form', ['project' => $project, 'services' => $services])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ المشروع
                </button>
                <a href="{{ route('admin.projects') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>
    </div>
@endsection

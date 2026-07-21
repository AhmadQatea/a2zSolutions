@extends('admin.layouts.app')

@section('title', 'تعديل مشروع')
@section('active_nav', 'admin.projects')
@section('page_title', 'تعديل المشروع')
@section('page_description', $project->title)

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}">
            @csrf
            @method('PUT')

            @include('admin.projects._form', ['project' => $project, 'services' => $services])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ التعديلات
                </button>
                <a href="{{ route('admin.projects') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا المشروع؟');">
            @csrf
            @method('DELETE')
            <button type="submit" class="adm-btn adm-btn--ghost adm-btn--sm">
                <span class="material-symbols-outlined">delete</span>
                حذف المشروع
            </button>
        </form>
    </div>
@endsection

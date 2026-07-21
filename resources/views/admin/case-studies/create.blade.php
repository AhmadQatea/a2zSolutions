@extends('admin.layouts.app')

@section('title', 'إضافة دراسة حالة')
@section('active_nav', 'admin.case-studies')
@section('page_title', 'إضافة دراسة حالة جديدة')
@section('page_description', 'أدخل بيانات دراسة الحالة الجديدة.')

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.case-studies.store') }}">
            @csrf

            @include('admin.case-studies._form', [
                'caseStudy' => $caseStudy,
                'services' => $services,
                'projects' => $projects,
                'focusOptions' => $focusOptions,
            ])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ دراسة الحالة
                </button>
                <a href="{{ route('admin.case-studies') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>
    </div>
@endsection

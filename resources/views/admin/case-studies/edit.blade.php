@extends('admin.layouts.app')

@section('title', 'تعديل دراسة حالة')
@section('active_nav', 'admin.case-studies')
@section('page_title', 'تعديل دراسة الحالة')
@section('page_description', $caseStudy->title)

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.case-studies.update', $caseStudy) }}">
            @csrf
            @method('PUT')

            @include('admin.case-studies._form', [
                'caseStudy' => $caseStudy,
                'services' => $services,
                'projects' => $projects,
                'focusOptions' => $focusOptions,
            ])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ التعديلات
                </button>
                <a href="{{ route('admin.case-studies') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.case-studies.destroy', $caseStudy) }}" onsubmit="return confirm('هل أنت متأكد من حذف دراسة الحالة؟');">
            @csrf
            @method('DELETE')
            <button type="submit" class="adm-btn adm-btn--ghost adm-btn--sm">
                <span class="material-symbols-outlined">delete</span>
                حذف دراسة الحالة
            </button>
        </form>
    </div>
@endsection

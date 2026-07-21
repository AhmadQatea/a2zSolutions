@extends('admin.layouts.app')

@section('title', 'إضافة خدمة')
@section('active_nav', 'admin.services')
@section('page_title', 'إضافة خدمة جديدة')
@section('page_description', 'أدخل بيانات الخدمة الجديدة لعرضها في الموقع.')

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.services.store') }}">
            @csrf

            @include('admin.services._form', ['service' => $service])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ الخدمة
                </button>
                <a href="{{ route('admin.services') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>
    </div>
@endsection

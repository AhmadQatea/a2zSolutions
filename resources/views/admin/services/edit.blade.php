@extends('admin.layouts.app')

@section('title', 'تعديل خدمة')
@section('active_nav', 'admin.services')
@section('page_title', 'تعديل الخدمة')
@section('page_description', $service->title)

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.services.update', $service) }}">
            @csrf
            @method('PUT')

            @include('admin.services._form', ['service' => $service])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ التعديلات
                </button>
                <a href="{{ route('admin.services') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة؟');">
            @csrf
            @method('DELETE')
            <button type="submit" class="adm-btn adm-btn--ghost adm-btn--sm">
                <span class="material-symbols-outlined">delete</span>
                حذف الخدمة
            </button>
        </form>
    </div>
@endsection

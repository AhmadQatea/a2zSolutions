@extends('admin.layouts.app')

@section('title', 'إضافة مقال')
@section('active_nav', 'admin.blog')
@section('page_title', 'إضافة مقال جديد')
@section('page_description', 'أدخل بيانات المقال الجديد لمركز المعرفة.')

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.blog.store') }}">
            @csrf

            @include('admin.blog._form', ['post' => $post])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ المقال
                </button>
                <a href="{{ route('admin.blog') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>
    </div>
@endsection

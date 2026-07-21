@extends('admin.layouts.app')

@section('title', 'تعديل مقال')
@section('active_nav', 'admin.blog')
@section('page_title', 'تعديل المقال')
@section('page_description', $post->title)

@section('content')
    <div class="adm-form-page adm-panel adm-panel--inner-glow">
        <form method="POST" action="{{ route('admin.blog.update', $post) }}">
            @csrf
            @method('PUT')

            @include('admin.blog._form', ['post' => $post])

            <div class="adm-form-actions">
                <button type="submit" class="adm-btn adm-btn--gold">
                    <span class="material-symbols-outlined">save</span>
                    حفظ التعديلات
                </button>
                <a href="{{ route('admin.blog') }}" class="adm-btn adm-btn--ghost">إلغاء</a>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟');">
            @csrf
            @method('DELETE')
            <button type="submit" class="adm-btn adm-btn--ghost adm-btn--sm">
                <span class="material-symbols-outlined">delete</span>
                حذف المقال
            </button>
        </form>
    </div>
@endsection

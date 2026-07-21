@extends('layouts.main')

@section('title', $page->title)

@section('meta_description', mb_substr(strip_tags($page->content), 0, 155))

@section('content')
    <article class="legal-page">
        <header class="legal-page__header">
            <h1 class="legal-page__title">{{ $page->title }}</h1>
            @if ($page->updated_at)
                <p class="legal-page__updated">آخر تحديث: {{ $page->updated_at->translatedFormat('d F Y') }}</p>
            @endif
        </header>

        <div class="legal-page__content">
            {!! nl2br(e($page->content)) !!}
        </div>
    </article>
@endsection

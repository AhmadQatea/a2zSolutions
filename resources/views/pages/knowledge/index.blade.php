@extends('layouts.main')

@section('full_width')
@endsection

@section('without_flash')
@endsection

@section('content')
    <div class="knowledge-page">
        <x-knowledge.hero />
        <x-knowledge.sections-nav />
        <x-knowledge.about />
        <x-knowledge.blog />
        <x-knowledge.tutorials />
        <x-knowledge.cta />
    </div>
@endsection

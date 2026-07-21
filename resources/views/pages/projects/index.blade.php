@extends('layouts.main')

@section('full_width')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/projects-page.css') }}">
@endpush

@section('content')
    <div class="projects-page">
        <div class="projects-page__bg" aria-hidden="true"></div>

        <div class="projects-page__content">
            <x-projects.hero />
            <x-projects.portfolio-grid />
            <x-projects.featured-case />
            <x-projects.solutions-finder />
            <x-projects.cost-calculator />
            <x-projects.quote-request />
            <x-projects.cta />
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/projects-page.js') }}" defer></script>
@endpush

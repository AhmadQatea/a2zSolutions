@extends('layouts.main')

@section('full_width')
@endsection

@section('without_flash')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/services-page.css') }}">
@endpush

@section('content')
    <div class="services-page">
        <div class="services-page__bg" aria-hidden="true"></div>

        <div class="services-page__content">
            <x-services.hero />
            <x-services.bento-grid />
            <x-services.faq />
            <x-services.cta />
        </div>
    </div>
@endsection

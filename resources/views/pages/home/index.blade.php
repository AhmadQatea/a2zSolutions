@extends('layouts.main')

@section('full_width')
@endsection

@section('without_flash')
@endsection

@section('content')
    <x-home.hero />
    <x-home.services />
    <x-home.why-choose-us />
    <x-home.projects />
    <x-home.cta />
@endsection

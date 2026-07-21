@extends('layouts.main')

@section('full_width')
@endsection

@section('content')
    <div class="contact-page">
        <x-contact.hero />
        <x-contact.info-cards />
        <x-contact.form-booking
            :booking-slots="$bookingSlots"
            :booked-dates="$bookedDates"
        />
        <x-contact.map-section />
        <x-contact.cta />
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/contact-page.js') }}" defer></script>
@endpush

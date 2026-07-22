@extends('admin.layouts.app')

@section('title', 'حجوزات الاستشارة')
@section('active_nav', 'admin.bookings')
@section('page_title', config('admin.bookings.title'))
@section('page_description', config('admin.bookings.description'))

@section('content')
    <div class="adm-mini-stats">
        @foreach ($stats as $stat)
            <div class="adm-mini-stat adm-panel adm-panel--inner-glow">
                <span class="adm-mini-stat__label">{{ $stat['label'] }}</span>
                <strong class="adm-mini-stat__value">{{ $stat['value'] }}</strong>
            </div>
        @endforeach
    </div>

    <div class="adm-bookings-grid">
        <section class="adm-panel adm-panel--inner-glow">
            <h3 class="adm-panel__title">{{ config('site.contact_page.booking.title') }}</h3>
            <p class="adm-panel__subtitle">{{ config('site.contact_page.booking.description') }}</p>

            <div
                class="adm-booking"
                data-adm-booking-calendar
                data-booked-days="{{ implode(',', $bookedDays) }}"
            >
                <div class="adm-booking__calendar">
                    <div class="adm-booking__calendar-head">
                        <button type="button" class="adm-booking__nav" data-adm-booking-prev aria-label="الشهر السابق">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                        <span class="adm-booking__month" data-adm-booking-month></span>
                        <button type="button" class="adm-booking__nav" data-adm-booking-next aria-label="الشهر التالي">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                    </div>

                    <div class="adm-booking__weekdays">
                        <span>ح</span><span>ن</span><span>ث</span><span>ر</span><span>خ</span><span>ج</span><span>س</span>
                    </div>

                    <div class="adm-booking__days" data-adm-booking-days></div>
                </div>

                <div class="adm-booking__legend">
                    <span><i class="adm-booking__dot adm-booking__dot--booked"></i> محجوز</span>
                    <span><i class="adm-booking__dot adm-booking__dot--free"></i> متاح</span>
                </div>

                <div class="adm-booking__slots">
                    <h4>الأوقات المتاحة يومياً:</h4>
                    <div class="adm-booking__times">
                        @foreach ($slots as $slot)
                            <span class="adm-tag">{{ $slot }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="adm-panel adm-panel--inner-glow">
            <div class="adm-panel__header">
                <h3 class="adm-panel__title">الحجوزات القادمة</h3>
            </div>

            <div class="adm-bookings-list">
                @forelse ($items as $booking)
                    <div class="adm-booking-item">
                        <div class="adm-booking-item__datetime">
                            <strong>{{ $booking['date'] }}</strong>
                            <span>{{ $booking['time'] }}</span>
                        </div>
                        <div class="adm-booking-item__info">
                            <strong>{{ $booking['client'] }}</strong>
                            <span>{{ $booking['note'] }}</span>
                            <small>{{ $booking['email'] }} • {{ $booking['phone'] }}</small>
                        </div>
                        <div class="adm-booking-item__actions">
                            <x-admin.status-badge :variant="$booking['status_variant']">{{ $booking['status'] }}</x-admin.status-badge>
                            @if ($booking['status_value'] === 'pending')
                                <form method="post" action="{{ route('admin.bookings.status', $booking['id']) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="adm-btn adm-btn--ghost adm-btn--sm">تأكيد</button>
                                </form>
                                <form method="post" action="{{ route('admin.bookings.status', $booking['id']) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="adm-btn adm-btn--ghost adm-btn--sm">إلغاء</button>
                                </form>
                            @elseif ($booking['status_value'] === 'confirmed')
                                <form method="post" action="{{ route('admin.bookings.status', $booking['id']) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="adm-btn adm-btn--ghost adm-btn--sm">إكمال</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>لا توجد حجوزات مسجلة.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection

@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')
@section('active_nav', 'admin.dashboard')
@section('page_title', config('admin.dashboard.title'))
@section('page_description', config('admin.dashboard.description'))

@section('content')
    <div class="adm-stats-grid">
        @foreach ($stats as $stat)
            <x-admin.stat-card
                :icon="$stat['icon']"
                :label="$stat['label']"
                :value="$stat['value']"
                :trend="$stat['trend']"
                :accent="$stat['accent']"
            />
        @endforeach
    </div>

    <div class="adm-dashboard-grid">
        <section class="adm-panel adm-panel--inner-glow">
            <div class="adm-panel__header">
                <h3 class="adm-panel__title">آخر الرسائل</h3>
                <a href="{{ route('admin.communications') }}" class="adm-link">عرض الكل</a>
            </div>

            <div class="adm-table-wrap">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>المرسل</th>
                            <th>نوع المشروع</th>
                            <th>التاريخ</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentMessages as $item)
                            <tr>
                                <td>
                                    <div class="adm-table__user">
                                        <span class="adm-table__icon material-symbols-outlined">mail</span>
                                        <div>
                                            <strong>{{ $item['name'] }}</strong>
                                            <span>{{ $item['email'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item['project_type'] }}</td>
                                <td>{{ $item['date'] }}</td>
                                <td>
                                    <x-admin.status-badge :variant="$item['status_variant']">{{ $item['status'] }}</x-admin.status-badge>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">لا توجد رسائل بعد.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <aside class="adm-dashboard-aside">
            <div class="adm-promo adm-panel adm-panel--inner-glow">
                <div class="adm-promo__bg" style="background-image: url('{{ asset(config('admin.brand.pattern')) }}');"></div>
                <div class="adm-promo__content">
                    <img src="{{ asset(config('admin.brand.logo_alt')) }}" alt="{{ config('admin.brand.company') }}" class="adm-promo__logo" loading="lazy">
                    <h3>{{ config('admin.dashboard.promo.title') }}</h3>
                    <p>{{ config('admin.dashboard.promo.description') }}</p>
                    <a href="{{ config('admin.dashboard.promo.href') }}" class="adm-btn adm-btn--gold adm-btn--sm" target="_blank">
                        {{ config('admin.dashboard.promo.button') }}
                    </a>
                </div>
            </div>

            <div class="adm-panel adm-panel--inner-glow">
                <div class="adm-panel__header">
                    <h3 class="adm-panel__title">حجوزات قادمة</h3>
                    <a href="{{ route('admin.bookings') }}" class="adm-link">التقويم</a>
                </div>
                <div class="adm-bookings-list adm-bookings-list--compact">
                    @forelse ($upcomingBookings as $booking)
                        <div class="adm-booking-item">
                            <div class="adm-booking-item__datetime">
                                <strong>{{ $booking['date'] }}</strong>
                                <span>{{ $booking['time'] }}</span>
                            </div>
                            <div class="adm-booking-item__info">
                                <strong>{{ $booking['client'] }}</strong>
                            </div>
                            <x-admin.status-badge :variant="$booking['status_variant']">{{ $booking['status'] }}</x-admin.status-badge>
                        </div>
                    @empty
                        <p>لا توجد حجوزات قادمة.</p>
                    @endforelse
                </div>
            </div>

            <div class="adm-panel adm-panel--inner-glow">
                <h3 class="adm-panel__title">صحة النظام</h3>
                <div class="adm-health">
                    @foreach (config('admin.dashboard.health') as $item)
                        <div class="adm-health__item">
                            <div class="adm-health__head">
                                <span>{{ $item['label'] }}</span>
                                <strong>{{ is_numeric($item['value']) ? $item['value'].'%' : $item['value'] }}</strong>
                            </div>
                            @if (is_numeric($item['value']))
                                <div class="adm-health__bar">
                                    <div class="adm-health__fill" style="width: {{ $item['value'] }}%;"></div>
                                </div>
                            @endif
                            <p class="adm-health__note">{{ $item['note'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
@endsection

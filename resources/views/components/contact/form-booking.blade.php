@props([
    'bookingSlots' => collect(),
    'bookedDates' => [],
])

@php
    $form = config('site.contact_page.form');
    $booking = config('site.contact_page.booking');
    $whatsappBase = 'https://wa.me/'.config('site.contact.whatsapp');
    $slots = $bookingSlots->isNotEmpty()
        ? $bookingSlots
        : collect([
            ['id' => null, 'time_label' => '09:00 ص', 'time_value' => '09:00'],
            ['id' => null, 'time_label' => '11:30 ص', 'time_value' => '11:30'],
            ['id' => null, 'time_label' => '02:00 م', 'time_value' => '14:00'],
            ['id' => null, 'time_label' => '04:30 م', 'time_value' => '16:30'],
        ]);
@endphp

<section class="contact-form-section">
    <div class="a2z-container">
        <div class="contact-form-section__grid">
            <div class="contact-form-section__form-card">
                <div class="contact-form-section__header">
                    <h2 class="contact-form-section__title">{{ $form['title'] }}</h2>
                    <p class="contact-form-section__description">{{ $form['description'] }}</p>
                </div>

                <form class="contact-form" action="{{ route('contact.store') }}" method="post" novalidate>
                    @csrf

                    <div class="contact-form__row">
                        <div class="contact-form__field">
                            <label class="contact-form__label" for="contact-name">الاسم الكامل</label>
                            <input
                                class="contact-form__input @error('name') contact-form__input--error @enderror"
                                id="contact-name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                placeholder="أدخل اسمك"
                                required
                                autocomplete="name"
                            >
                            @error('name')
                                <span class="contact-form__error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="contact-form__field">
                            <label class="contact-form__label" for="contact-email">البريد الإلكتروني</label>
                            <input
                                class="contact-form__input @error('email') contact-form__input--error @enderror"
                                id="contact-email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="example@domain.com"
                                required
                                autocomplete="email"
                            >
                            @error('email')
                                <span class="contact-form__error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="contact-form__field">
                        <label class="contact-form__label" for="contact-phone">الهاتف (اختياري)</label>
                        <input
                            class="contact-form__input @error('phone') contact-form__input--error @enderror"
                            id="contact-phone"
                            name="phone"
                            type="tel"
                            value="{{ old('phone') }}"
                            placeholder="+963 9xx xxx xxx"
                            autocomplete="tel"
                        >
                        @error('phone')
                            <span class="contact-form__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-form__field">
                        <label class="contact-form__label" for="contact-type">نوع المشروع</label>
                        <select
                            class="contact-form__input contact-form__select @error('project_type') contact-form__input--error @enderror"
                            id="contact-type"
                            name="project_type"
                            required
                        >
                            @foreach ($form['project_types'] as $type)
                                <option value="{{ $type }}" @selected(old('project_type') === $type)>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('project_type')
                            <span class="contact-form__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-form__field">
                        <label class="contact-form__label" for="contact-message">تفاصيل الرسالة</label>
                        <textarea
                            class="contact-form__input contact-form__textarea @error('message') contact-form__input--error @enderror"
                            id="contact-message"
                            name="message"
                            rows="4"
                            placeholder="كيف يمكننا مساعدتك؟"
                            required
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <span class="contact-form__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <x-ui.button variant="gold" size="lg" type="submit" icon="send" class="contact-form__submit">
                        {{ $form['submit_label'] }}
                    </x-ui.button>
                </form>
            </div>

            <div
                id="booking"
                class="contact-form-section__booking-card"
                data-contact-booking
                data-whatsapp-url="{{ $whatsappBase }}"
                data-whatsapp-message="{{ $booking['whatsapp_message'] }}"
                data-booked-days="{{ implode(',', $bookedDates) }}"
            >
                <div class="contact-form-section__header">
                    <h2 class="contact-form-section__title">{{ $booking['title'] }}</h2>
                    <p class="contact-form-section__description">{{ $booking['description'] }}</p>
                </div>

                <form
                    class="contact-booking"
                    action="{{ route('contact.booking.store') }}"
                    method="post"
                    data-booking-form
                >
                    @csrf

                    <input type="hidden" name="booking_date" value="{{ old('booking_date') }}" data-booking-date-input>
                    <input type="hidden" name="time_label" value="{{ old('time_label') }}" data-booking-time-input>
                    <input type="hidden" name="booking_slot_id" value="{{ old('booking_slot_id') }}" data-booking-slot-input>

                    <div class="contact-form__row">
                        <div class="contact-form__field">
                            <label class="contact-form__label" for="booking-name">الاسم الكامل</label>
                            <input
                                class="contact-form__input @error('client_name') contact-form__input--error @enderror"
                                id="booking-name"
                                name="client_name"
                                type="text"
                                value="{{ old('client_name') }}"
                                placeholder="أدخل اسمك"
                                required
                                autocomplete="name"
                            >
                            @error('client_name')
                                <span class="contact-form__error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="contact-form__field">
                            <label class="contact-form__label" for="booking-email">البريد الإلكتروني</label>
                            <input
                                class="contact-form__input @error('email', 'booking') contact-form__input--error @enderror"
                                id="booking-email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="example@domain.com"
                                required
                                autocomplete="email"
                            >
                            @error('email')
                                <span class="contact-form__error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="contact-form__field">
                        <label class="contact-form__label" for="booking-phone">الهاتف (اختياري)</label>
                        <input
                            class="contact-form__input @error('phone', 'booking') contact-form__input--error @enderror"
                            id="booking-phone"
                            name="phone"
                            type="tel"
                            value="{{ old('phone') }}"
                            placeholder="+963 9xx xxx xxx"
                            autocomplete="tel"
                        >
                        @error('phone')
                            <span class="contact-form__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-booking__calendar">
                        <div class="contact-booking__calendar-head">
                            <button type="button" class="contact-booking__nav" data-booking-prev aria-label="الشهر السابق">
                                <x-ui.icon name="chevron_right" />
                            </button>
                            <span class="contact-booking__month" data-booking-month></span>
                            <button type="button" class="contact-booking__nav" data-booking-next aria-label="الشهر التالي">
                                <x-ui.icon name="chevron_left" />
                            </button>
                        </div>

                        <div class="contact-booking__weekdays">
                            <span>ح</span><span>ن</span><span>ث</span><span>ر</span><span>خ</span><span>ج</span><span>س</span>
                        </div>

                        <div class="contact-booking__days" data-booking-days></div>
                    </div>

                    <div class="contact-booking__slots" data-booking-slots hidden>
                        <h4 class="contact-booking__slots-title" data-booking-slots-title>الأوقات المتاحة:</h4>
                        <div class="contact-booking__times" data-booking-times>
                            @foreach ($slots as $slot)
                                <button
                                    type="button"
                                    class="contact-booking__time"
                                    data-booking-time="{{ is_array($slot) ? $slot['time_value'] : $slot->time_value }}"
                                    data-booking-slot-id="{{ is_array($slot) ? ($slot['id'] ?? '') : $slot->id }}"
                                    data-booking-time-label="{{ is_array($slot) ? $slot['time_label'] : $slot->time_label }}"
                                >
                                    {{ is_array($slot) ? $slot['time_label'] : $slot->time_label }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="contact-form__field">
                        <label class="contact-form__label" for="booking-note">ملاحظة (اختياري)</label>
                        <textarea
                            class="contact-form__input contact-form__textarea"
                            id="booking-note"
                            name="note"
                            rows="2"
                            placeholder="أخبرنا باختصار عن مشروعك"
                        >{{ old('note') }}</textarea>
                        @error('booking_date')
                            <span class="contact-form__error">{{ $message }}</span>
                        @enderror
                        @error('time_label')
                            <span class="contact-form__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-booking__actions">
                        <button type="submit" class="contact-booking__confirm a2z-btn a2z-btn--gold" data-booking-submit>
                            {{ $booking['confirm_label'] }}
                            <x-ui.icon name="event_available" />
                        </button>
                        <a
                            href="{{ $whatsappBase }}"
                            class="contact-booking__whatsapp a2z-btn a2z-btn--outline"
                            data-booking-confirm
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            واتساب
                            <x-ui.icon name="chat" />
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@php
    $quote = config('site.projects_page.quote');
    $contact = config('site.contact');
    $whatsappUrl = 'https://wa.me/'.$contact['whatsapp'];
@endphp

<section id="quote-request" class="quote-request">
    <div class="a2z-container">
        <div class="quote-request__header">
            <h2 class="quote-request__title">{{ $quote['title'] }}</h2>
            <p class="quote-request__description">{{ $quote['description'] }}</p>
        </div>

        <div class="quote-request__grid">
            <div class="quote-request__form-card">
                <h3 class="quote-request__form-title">أرسل لنا تفاصيل مشروعك</h3>

                <form class="quote-request__form" action="{{ route('projects.quote.store') }}" method="post" novalidate>
                    @csrf

                    <div class="quote-request__fields-row">
                        <div class="quote-request__field">
                            <label class="quote-request__label" for="quote-name">الاسم الكامل</label>
                            <input
                                class="quote-request__input @error('name') quote-request__input--error @enderror"
                                id="quote-name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                placeholder="أدخل اسمك"
                                required
                                autocomplete="name"
                            >
                            @error('name')
                                <span class="quote-request__error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-request__field">
                            <label class="quote-request__label" for="quote-email">البريد الإلكتروني</label>
                            <input
                                class="quote-request__input @error('email') quote-request__input--error @enderror"
                                id="quote-email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="email@example.com"
                                required
                                autocomplete="email"
                            >
                            @error('email')
                                <span class="quote-request__error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="quote-request__field">
                        <label class="quote-request__label" for="quote-phone">رقم الهاتف</label>
                        <input
                            class="quote-request__input @error('phone') quote-request__input--error @enderror"
                            id="quote-phone"
                            name="phone"
                            type="tel"
                            value="{{ old('phone') }}"
                            placeholder="+963..."
                            dir="ltr"
                            autocomplete="tel"
                        >
                        @error('phone')
                            <span class="quote-request__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="quote-request__field">
                        <label class="quote-request__label" for="quote-subject">الموضوع</label>
                        <select
                            class="quote-request__input quote-request__select @error('subject') quote-request__input--error @enderror"
                            id="quote-subject"
                            name="subject"
                            required
                        >
                            @foreach ($quote['subjects'] as $subject)
                                <option value="{{ $subject }}" @selected(old('subject') === $subject)>{{ $subject }}</option>
                            @endforeach
                        </select>
                        @error('subject')
                            <span class="quote-request__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="quote-request__field">
                        <label class="quote-request__label" for="quote-message">تفاصيل المشروع</label>
                        <textarea
                            class="quote-request__input quote-request__textarea @error('message') quote-request__input--error @enderror"
                            id="quote-message"
                            name="message"
                            rows="5"
                            placeholder="صف مشروعك، أهدافك، والميزات المطلوبة..."
                            required
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <span class="quote-request__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <x-ui.button variant="gold" size="lg" type="submit" icon="send" class="quote-request__submit">
                        {{ $quote['submit_label'] }}
                    </x-ui.button>
                </form>
            </div>

            <div class="quote-request__sidebar">
                <a href="mailto:{{ $contact['email'] }}" class="quote-request__contact-card">
                    <span class="quote-request__contact-icon">
                        <x-ui.icon name="mail" />
                    </span>
                    <span class="quote-request__contact-label">البريد الإلكتروني</span>
                    <span class="quote-request__contact-value">{{ $contact['email'] }}</span>
                </a>

                <a
                    href="{{ $whatsappUrl }}"
                    class="quote-request__contact-card"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <span class="quote-request__contact-icon">
                        <x-ui.icon name="chat" />
                    </span>
                    <span class="quote-request__contact-label">واتساب مباشر</span>
                    <span class="quote-request__contact-value" dir="ltr">{{ $contact['phone'] }}</span>
                </a>

                <div class="quote-request__info-card">
                    <h4 class="quote-request__info-title">ماذا يحدث بعد الإرسال؟</h4>
                    <ul class="quote-request__info-list">
                        <li>مراجعة طلبك خلال 24 ساعة</li>
                        <li>جلسة استشارة مجانية عبر الاتصال أو الواتساب</li>
                        <li>عرض سعر مفصل مخصص لمتطلباتك</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@extends('admin.layouts.app')

@section('title', 'إعدادات الموقع')
@section('active_nav', 'admin.settings')
@section('page_title', config('admin.settings.title'))
@section('page_description', config('admin.settings.description'))

@section('content')
    <div class="adm-settings-grid">
        <section class="adm-panel adm-panel--inner-glow">
            <h3 class="adm-panel__title">{{ config('admin.settings.sections.brand') }}</h3>

            <div class="adm-settings-brand">
                <div class="adm-upload-preview">
                    <img src="{{ asset(config('admin.brand.logo')) }}" alt="الشعار الرئيسي" loading="lazy">
                    <div>
                        <strong>الشعار الرئيسي</strong>
                        <span>logo.png — للوحة والموقع</span>
                    </div>
                    <button type="button" class="adm-btn adm-btn--outline adm-btn--sm">تغيير</button>
                </div>

                <div class="adm-upload-preview">
                    <img src="{{ asset(config('admin.brand.logo_alt')) }}" alt="الشعار البديل" loading="lazy">
                    <div>
                        <strong>الشعار الأفقي</strong>
                        <span>logo2.png — للهيدر والفوتر</span>
                    </div>
                    <button type="button" class="adm-btn adm-btn--outline adm-btn--sm">تغيير</button>
                </div>

                <div class="adm-upload-preview adm-upload-preview--pattern">
                    <div class="adm-upload-preview__pattern" style="background-image: url('{{ asset(config('admin.brand.pattern')) }}');"></div>
                    <div>
                        <strong>خلفية النمط</strong>
                        <span>mvpd.jpg — للـ Hero وCTA</span>
                    </div>
                    <button type="button" class="adm-btn adm-btn--outline adm-btn--sm">تغيير</button>
                </div>
            </div>

            <div class="adm-form-grid">
                <label class="adm-field">
                    <span class="adm-field__label">اسم الشركة</span>
                    <input type="text" class="adm-field__input adm-field__input--standalone" value="{{ $brand['name'] }}" readonly>
                </label>
                <label class="adm-field">
                    <span class="adm-field__label">الشعار النصي</span>
                    <input type="text" class="adm-field__input adm-field__input--standalone" value="{{ $brand['tagline'] }}" readonly>
                </label>
            </div>
        </section>

        <section class="adm-panel adm-panel--inner-glow">
            <h3 class="adm-panel__title">{{ config('admin.settings.sections.contact') }}</h3>

            <div class="adm-form-grid">
                <label class="adm-field">
                    <span class="adm-field__label">البريد الإلكتروني</span>
                    <input type="email" class="adm-field__input adm-field__input--standalone" value="{{ $contact['email'] }}" readonly>
                </label>
                <label class="adm-field">
                    <span class="adm-field__label">الهاتف / واتساب</span>
                    <input type="text" class="adm-field__input adm-field__input--standalone" value="{{ $contact['phone'] }}" readonly>
                </label>
                <label class="adm-field adm-field--full">
                    <span class="adm-field__label">الموقع</span>
                    <input type="text" class="adm-field__input adm-field__input--standalone" value="{{ $contact['location'] }}" readonly>
                </label>
                <label class="adm-field adm-field--full">
                    <span class="adm-field__label">الإحداثيات</span>
                    <input type="text" class="adm-field__input adm-field__input--standalone" value="{{ $contact['coordinates']['lat'] }}, {{ $contact['coordinates']['lng'] }}" readonly>
                </label>
            </div>
        </section>

        <section class="adm-panel adm-panel--inner-glow">
            <h3 class="adm-panel__title">{{ config('admin.settings.sections.seo') }}</h3>

            <div class="adm-form-grid">
                <label class="adm-field adm-field--full">
                    <span class="adm-field__label">وصف الصفحة الرئيسية</span>
                    <textarea class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" readonly>{{ $seo['hero_description'] }}</textarea>
                </label>
                <label class="adm-field adm-field--full">
                    <span class="adm-field__label">وصف صفحة الخدمات</span>
                    <textarea class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="2" readonly>{{ $seo['services_description'] }}</textarea>
                </label>
                <label class="adm-field adm-field--full">
                    <span class="adm-field__label">وصف صفحة المشاريع</span>
                    <textarea class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="2" readonly>{{ $seo['projects_description'] }}</textarea>
                </label>
            </div>
        </section>

        <section class="adm-panel adm-panel--inner-glow">
            <h3 class="adm-panel__title">{{ config('admin.settings.sections.social') }}</h3>

            <div class="adm-social-list">
                @foreach ($social as $item)
                    <div class="adm-social-item">
                        <div class="adm-icon adm-icon--navy">
                            <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                        </div>
                        <div class="adm-social-item__info">
                            <strong>{{ $item['label'] }}</strong>
                            <a href="{{ $item['href'] }}" target="_blank" rel="noopener">{{ $item['href'] }}</a>
                        </div>
                        <button type="button" class="adm-btn adm-btn--ghost adm-btn--sm">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <div class="adm-settings-footer">
        <button type="button" class="adm-btn adm-btn--gold">
            <span class="material-symbols-outlined">save</span>
            حفظ التغييرات
        </button>
        <p class="adm-settings-footer__note">البيانات المعروضة من قاعدة البيانات — التعديل عبر لوحة الإعدادات قريباً.</p>
    </div>
@endsection

@extends('admin.layouts.app')

@section('title', 'إعدادات الموقع')
@section('active_nav', 'admin.settings')
@section('page_title', config('admin.settings.title'))
@section('page_description', config('admin.settings.description'))

@section('content')
    <form method="post" action="{{ route('admin.settings.update') }}" class="adm-settings-form">
        @csrf
        @method('PUT')

        <div class="adm-settings-grid">
            <section class="adm-panel adm-panel--inner-glow">
                <h3 class="adm-panel__title">{{ config('admin.settings.sections.brand') }}</h3>

                <div class="adm-form-grid">
                    <label class="adm-field">
                        <span class="adm-field__label">اسم الشركة</span>
                        <input type="text" name="brand_name" class="adm-field__input adm-field__input--standalone" value="{{ old('brand_name', $brand['name']) }}" required>
                    </label>
                    <label class="adm-field">
                        <span class="adm-field__label">الشعار النصي</span>
                        <input type="text" name="brand_tagline" class="adm-field__input adm-field__input--standalone" value="{{ old('brand_tagline', $brand['tagline']) }}" required>
                    </label>
                </div>
            </section>

            <section class="adm-panel adm-panel--inner-glow">
                <h3 class="adm-panel__title">{{ config('admin.settings.sections.contact') }}</h3>

                <div class="adm-form-grid">
                    <label class="adm-field">
                        <span class="adm-field__label">البريد الإلكتروني</span>
                        <input type="email" name="contact_email" class="adm-field__input adm-field__input--standalone" value="{{ old('contact_email', $contact['email']) }}" required>
                    </label>
                    <label class="adm-field">
                        <span class="adm-field__label">الهاتف / واتساب</span>
                        <input type="text" name="contact_phone" class="adm-field__input adm-field__input--standalone" value="{{ old('contact_phone', $contact['phone']) }}" required>
                    </label>
                    <label class="adm-field adm-field--full">
                        <span class="adm-field__label">الموقع</span>
                        <input type="text" name="contact_location" class="adm-field__input adm-field__input--standalone" value="{{ old('contact_location', $contact['location']) }}" required>
                    </label>
                    <label class="adm-field">
                        <span class="adm-field__label">خط العرض</span>
                        <input type="text" name="contact_lat" class="adm-field__input adm-field__input--standalone" value="{{ old('contact_lat', $contact['coordinates']['lat']) }}" required>
                    </label>
                    <label class="adm-field">
                        <span class="adm-field__label">خط الطول</span>
                        <input type="text" name="contact_lng" class="adm-field__input adm-field__input--standalone" value="{{ old('contact_lng', $contact['coordinates']['lng']) }}" required>
                    </label>
                </div>
            </section>

            <section class="adm-panel adm-panel--inner-glow">
                <h3 class="adm-panel__title">{{ config('admin.settings.sections.seo') }}</h3>

                <div class="adm-form-grid">
                    <label class="adm-field adm-field--full">
                        <span class="adm-field__label">وصف الصفحة الرئيسية</span>
                        <textarea name="seo_hero_description" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" required>{{ old('seo_hero_description', $seo['hero_description']) }}</textarea>
                    </label>
                    <label class="adm-field adm-field--full">
                        <span class="adm-field__label">وصف صفحة الخدمات</span>
                        <textarea name="seo_services_description" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="2">{{ old('seo_services_description', $seo['services_description']) }}</textarea>
                    </label>
                    <label class="adm-field adm-field--full">
                        <span class="adm-field__label">وصف صفحة المشاريع</span>
                        <textarea name="seo_projects_description" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="2">{{ old('seo_projects_description', $seo['projects_description']) }}</textarea>
                    </label>
                </div>
            </section>

            <section class="adm-panel adm-panel--inner-glow">
                <h3 class="adm-panel__title">{{ config('admin.settings.sections.social') }}</h3>

                <div class="adm-social-list">
                    @foreach ($social as $index => $item)
                        <div class="adm-social-item">
                            <div class="adm-icon adm-icon--navy">
                                <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                            </div>
                            <div class="adm-social-item__info adm-form-grid" style="flex:1; grid-template-columns: 1fr 2fr; gap: 0.5rem;">
                                @if (! empty($item['id']))
                                    <input type="hidden" name="social[{{ $index }}][id]" value="{{ $item['id'] }}">
                                @endif
                                <input type="text" name="social[{{ $index }}][label]" class="adm-field__input adm-field__input--standalone" value="{{ old('social.'.$index.'.label', $item['label']) }}" placeholder="الاسم">
                                <input type="text" name="social[{{ $index }}][href]" class="adm-field__input adm-field__input--standalone" value="{{ old('social.'.$index.'.href', $item['href']) }}" placeholder="الرابط">
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <div class="adm-settings-footer">
            <button type="submit" class="adm-btn adm-btn--gold">
                <span class="material-symbols-outlined">save</span>
                حفظ التغييرات
            </button>
        </div>
    </form>
@endsection

@php
    $iconVariants = ['navy' => 'كحلي', 'teal' => 'فيروزي', 'gold' => 'ذهبي'];
    $featuresValue = old('features', is_array($service->features ?? null) ? implode("\n", $service->features) : $service->features);
@endphp

<div class="adm-form-grid">
    <label class="adm-field">
        <span class="adm-field__label">العنوان</span>
        <input type="text" name="title" value="{{ old('title', $service->title) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('title')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">الاختصار (Slug)</span>
        <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" class="adm-field__input adm-field__input--standalone" placeholder="يُنشأ تلقائياً من العنوان إن ترك فارغاً">
        @error('slug')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">أيقونة (Material Symbol)</span>
        <input type="text" name="icon" value="{{ old('icon', $service->icon) }}" class="adm-field__input adm-field__input--standalone" placeholder="settings_suggest">
        @error('icon')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">نمط الأيقونة</span>
        <select name="icon_variant" class="adm-field__input adm-field__input--standalone" required>
            @foreach ($iconVariants as $value => $label)
                <option value="{{ $value }}" @selected(old('icon_variant', $service->icon_variant) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('icon_variant')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">الوصف</span>
        <textarea name="description" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" required>{{ old('description', $service->description) }}</textarea>
        @error('description')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">الوصف التفصيلي</span>
        <textarea name="long_description" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="4">{{ old('long_description', $service->long_description) }}</textarea>
        @error('long_description')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">الميزات</span>
        <textarea name="features" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="4">{{ $featuresValue }}</textarea>
        <span class="adm-field__hint">أدخل كل ميزة في سطر منفصل</span>
        @error('features')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">تخطيط البطاقة</span>
        <input type="text" name="layout" value="{{ old('layout', $service->layout) }}" class="adm-field__input adm-field__input--standalone">
        @error('layout')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">أيقونة الزخرفة</span>
        <input type="text" name="decor_icon" value="{{ old('decor_icon', $service->decor_icon) }}" class="adm-field__input adm-field__input--standalone">
        @error('decor_icon')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">نص الرابط</span>
        <input type="text" name="link_label" value="{{ old('link_label', $service->link_label) }}" class="adm-field__input adm-field__input--standalone">
        @error('link_label')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">رابط (href)</span>
        <input type="text" name="href" value="{{ old('href', $service->href) }}" class="adm-field__input adm-field__input--standalone">
        @error('href')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">مسار الصورة</span>
        <input type="text" name="image_path" value="{{ old('image_path', $service->image_path) }}" class="adm-field__input adm-field__input--standalone">
        @error('image_path')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">وصف الصورة (Alt)</span>
        <input type="text" name="image_alt" value="{{ old('image_alt', $service->image_alt) }}" class="adm-field__input adm-field__input--standalone">
        @error('image_alt')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">السعر الأساسي</span>
        <input type="number" name="base_price" min="0" value="{{ old('base_price', $service->base_price) }}" class="adm-field__input adm-field__input--standalone">
        @error('base_price')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">ترتيب العرض</span>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $service->sort_order) }}" class="adm-field__input adm-field__input--standalone">
        @error('sort_order')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <div class="adm-field adm-field--full">
        <label class="adm-check">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $service->is_published))>
            <span>منشورة</span>
        </label>
        <label class="adm-check">
            <input type="checkbox" name="show_on_home" value="1" @checked(old('show_on_home', $service->show_on_home))>
            <span>إظهار في الرئيسية</span>
        </label>
        <label class="adm-check">
            <input type="checkbox" name="show_on_services_page" value="1" @checked(old('show_on_services_page', $service->show_on_services_page))>
            <span>إظهار في صفحة الخدمات</span>
        </label>
    </div>
</div>

@php
    $tagsValue = old('tags', is_array($project->tags ?? null) ? implode("\n", $project->tags) : $project->tags);
@endphp

<div class="adm-form-grid">
    <label class="adm-field">
        <span class="adm-field__label">الخدمة المرتبطة</span>
        <select name="service_id" class="adm-field__input adm-field__input--standalone">
            <option value="">— بدون خدمة —</option>
            @foreach ($services as $id => $title)
                <option value="{{ $id }}" @selected((string) old('service_id', $project->service_id) === (string) $id)>{{ $title }}</option>
            @endforeach
        </select>
        @error('service_id')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">العنوان</span>
        <input type="text" name="title" value="{{ old('title', $project->title) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('title')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">الوصف</span>
        <textarea name="description" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" required>{{ old('description', $project->description) }}</textarea>
        @error('description')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">مسار الصورة</span>
        <input type="text" name="image_path" value="{{ old('image_path', $project->image_path) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('image_path')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">وصف الصورة (Alt)</span>
        <input type="text" name="image_alt" value="{{ old('image_alt', $project->image_alt) }}" class="adm-field__input adm-field__input--standalone">
        @error('image_alt')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">الوسوم (Tags)</span>
        <textarea name="tags" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3">{{ $tagsValue }}</textarea>
        <span class="adm-field__hint">أدخل كل وسم في سطر منفصل</span>
        @error('tags')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">ترتيب التمييز</span>
        <input type="number" name="featured_order" min="0" value="{{ old('featured_order', $project->featured_order) }}" class="adm-field__input adm-field__input--standalone">
        @error('featured_order')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">ترتيب العرض</span>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $project->sort_order) }}" class="adm-field__input adm-field__input--standalone">
        @error('sort_order')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <div class="adm-field adm-field--full">
        <label class="adm-check">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project->is_featured))>
            <span>مميز للصفحة الرئيسية</span>
        </label>
        <label class="adm-check">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $project->is_published))>
            <span>منشور</span>
        </label>
    </div>
</div>

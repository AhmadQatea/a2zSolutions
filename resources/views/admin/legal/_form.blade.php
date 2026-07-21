<div class="adm-form-grid">
    <label class="adm-field adm-field--full">
        <span class="adm-field__label">العنوان</span>
        <input type="text" name="title" value="{{ old('title', $page->title) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('title')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">المحتوى</span>
        <textarea name="content" class="adm-field__input adm-field__input--standalone adm-field__textarea adm-field__textarea--lg" rows="14" required>{{ old('content', $page->content) }}</textarea>
        @error('content')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <div class="adm-field adm-field--full">
        <label class="adm-check">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $page->is_published))>
            <span>منشورة</span>
        </label>
    </div>
</div>

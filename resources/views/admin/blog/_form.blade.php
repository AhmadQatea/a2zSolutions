@php
    $statusOptions = ['draft' => 'مسودة', 'published' => 'منشور'];
    $currentStatus = old('status', $post->status instanceof \App\Enums\BlogPostStatus ? $post->status->value : $post->status);
    $publishedAtValue = old('published_at', $post->published_at?->format('Y-m-d\TH:i'));
@endphp

<div class="adm-form-grid">
    <label class="adm-field">
        <span class="adm-field__label">العنوان</span>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('title')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">الاختصار (Slug)</span>
        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="adm-field__input adm-field__input--standalone" placeholder="يُنشأ تلقائياً من العنوان إن ترك فارغاً">
        @error('slug')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">التصنيف</span>
        <input type="text" name="category" value="{{ old('category', $post->category) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('category')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">الحالة</span>
        <select name="status" class="adm-field__input adm-field__input--standalone" required>
            @foreach ($statusOptions as $value => $label)
                <option value="{{ $value }}" @selected($currentStatus === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">المقتطف</span>
        <textarea name="excerpt" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" required>{{ old('excerpt', $post->excerpt) }}</textarea>
        @error('excerpt')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">المحتوى</span>
        <textarea name="content" class="adm-field__input adm-field__input--standalone adm-field__textarea adm-field__textarea--lg" rows="10">{{ old('content', $post->content) }}</textarea>
        @error('content')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">مسار الصورة</span>
        <input type="text" name="image_path" value="{{ old('image_path', $post->image_path) }}" class="adm-field__input adm-field__input--standalone">
        @error('image_path')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">وصف الصورة (Alt)</span>
        <input type="text" name="image_alt" value="{{ old('image_alt', $post->image_alt) }}" class="adm-field__input adm-field__input--standalone">
        @error('image_alt')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">مدة القراءة (دقائق)</span>
        <input type="number" name="read_time_minutes" min="1" value="{{ old('read_time_minutes', $post->read_time_minutes) }}" class="adm-field__input adm-field__input--standalone">
        @error('read_time_minutes')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">تاريخ النشر</span>
        <input type="datetime-local" name="published_at" value="{{ $publishedAtValue }}" class="adm-field__input adm-field__input--standalone">
        @error('published_at')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">ترتيب العرض</span>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $post->sort_order) }}" class="adm-field__input adm-field__input--standalone">
        @error('sort_order')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>
</div>

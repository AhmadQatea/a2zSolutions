@php
    $typeOptions = ['feature' => 'ميزة', 'improvement' => 'تحسين', 'fix' => 'إصلاح', 'release' => 'إصدار'];
    $currentType = old('type', $entry->type instanceof \App\Enums\ChangelogEntryType ? $entry->type->value : $entry->type);
    $releasedAtValue = old('released_at', $entry->released_at?->format('Y-m-d'));
@endphp

<div class="adm-form-grid">
    <label class="adm-field">
        <span class="adm-field__label">رقم الإصدار</span>
        <input type="text" name="version" value="{{ old('version', $entry->version) }}" class="adm-field__input adm-field__input--standalone" placeholder="1.5.0" required>
        @error('version')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">تاريخ الإصدار</span>
        <input type="date" name="released_at" value="{{ $releasedAtValue }}" class="adm-field__input adm-field__input--standalone" required>
        @error('released_at')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">النوع</span>
        <select name="type" class="adm-field__input adm-field__input--standalone" required>
            @foreach ($typeOptions as $value => $label)
                <option value="{{ $value }}" @selected($currentType === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('type')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">الكاتب</span>
        <input type="text" name="author_name" value="{{ old('author_name', $entry->author_name) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('author_name')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">العنوان</span>
        <input type="text" name="title" value="{{ old('title', $entry->title) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('title')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">الوصف</span>
        <textarea name="description" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" required>{{ old('description', $entry->description) }}</textarea>
        @error('description')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>
</div>

@php
    $stackValue = old('stack', is_array($caseStudy->stack ?? null) ? implode("\n", $caseStudy->stack) : $caseStudy->stack);
    $resultsValue = old('results', is_array($caseStudy->results ?? null)
        ? implode("\n", array_map(fn ($result) => ($result['value'] ?? '').'|'.($result['label'] ?? ''), $caseStudy->results))
        : $caseStudy->results);
    $currentFocusType = old('focus_type', $caseStudy->focus_type instanceof \App\Enums\CaseStudyFocusType ? $caseStudy->focus_type->value : $caseStudy->focus_type);
@endphp

<div class="adm-form-grid">
    <label class="adm-field">
        <span class="adm-field__label">الخدمة</span>
        <select name="service_id" class="adm-field__input adm-field__input--standalone" required>
            <option value="">— اختر خدمة —</option>
            @foreach ($services as $id => $title)
                <option value="{{ $id }}" @selected((string) old('service_id', $caseStudy->service_id) === (string) $id)>{{ $title }}</option>
            @endforeach
        </select>
        @error('service_id')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">المشروع (اختياري)</span>
        <select name="project_id" class="adm-field__input adm-field__input--standalone">
            <option value="">— بدون مشروع —</option>
            @foreach ($projects as $id => $title)
                <option value="{{ $id }}" @selected((string) old('project_id', $caseStudy->project_id) === (string) $id)>{{ $title }}</option>
            @endforeach
        </select>
        @error('project_id')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">نوع العرض</span>
        <select name="focus_type" class="adm-field__input adm-field__input--standalone" required>
            @foreach ($focusOptions as $value => $label)
                <option value="{{ $value }}" @selected($currentFocusType === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('focus_type')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">العنوان</span>
        <input type="text" name="title" value="{{ old('title', $caseStudy->title) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('title')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">العميل</span>
        <input type="text" name="client" value="{{ old('client', $caseStudy->client) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('client')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">المدة</span>
        <input type="text" name="duration" value="{{ old('duration', $caseStudy->duration) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('duration')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">مسار الصورة</span>
        <input type="text" name="image_path" value="{{ old('image_path', $caseStudy->image_path) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('image_path')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">وصف الصورة (Alt)</span>
        <input type="text" name="image_alt" value="{{ old('image_alt', $caseStudy->image_alt) }}" class="adm-field__input adm-field__input--standalone">
        @error('image_alt')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">قيمة الإنجاز</span>
        <input type="text" name="highlight_value" value="{{ old('highlight_value', $caseStudy->highlight_value) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('highlight_value')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">وصف الإنجاز</span>
        <input type="text" name="highlight_label" value="{{ old('highlight_label', $caseStudy->highlight_label) }}" class="adm-field__input adm-field__input--standalone" required>
        @error('highlight_label')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">المشكلة</span>
        <textarea name="problem" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3">{{ old('problem', $caseStudy->problem) }}</textarea>
        @error('problem')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">الحل التقني</span>
        <textarea name="solution" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3">{{ old('solution', $caseStudy->solution) }}</textarea>
        @error('solution')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">الهدف</span>
        <textarea name="goal" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3">{{ old('goal', $caseStudy->goal) }}</textarea>
        @error('goal')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">ما قمنا به</span>
        <textarea name="actions_taken" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3">{{ old('actions_taken', $caseStudy->actions_taken) }}</textarea>
        @error('actions_taken')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">التقنيات المستخدمة (Stack)</span>
        <textarea name="stack" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3">{{ $stackValue }}</textarea>
        <span class="adm-field__hint">أدخل كل تقنية في سطر منفصل</span>
        @error('stack')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field adm-field--full">
        <span class="adm-field__label">النتائج</span>
        <textarea name="results" class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3">{{ $resultsValue }}</textarea>
        <span class="adm-field__hint">أدخل كل نتيجة بصيغة: القيمة|الوصف — كل نتيجة في سطر منفصل (مثال: -38%|تقليل الغياب)</span>
        @error('results')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="adm-field">
        <span class="adm-field__label">ترتيب العرض</span>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $caseStudy->sort_order) }}" class="adm-field__input adm-field__input--standalone">
        @error('sort_order')
            <span class="adm-field__error">{{ $message }}</span>
        @enderror
    </label>

    <div class="adm-field adm-field--full">
        <label class="adm-check">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $caseStudy->is_published))>
            <span>منشورة</span>
        </label>
    </div>
</div>

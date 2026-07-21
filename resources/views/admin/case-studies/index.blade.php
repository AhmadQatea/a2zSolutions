@extends('admin.layouts.app')

@section('title', 'دراسات الحالة')
@section('active_nav', 'admin.case-studies')
@section('page_title', config('admin.case_studies.title'))
@section('page_description', config('admin.case_studies.description'))

@section('content')
    <div class="adm-toolbar">
        <p class="adm-toolbar__hint">اختر نوع العرض: <strong>المشكلة + الحل التقني</strong> أو <strong>الهدف + ما قمنا به</strong></p>
        <button type="button" class="adm-btn adm-btn--gold adm-btn--sm">
            <span class="material-symbols-outlined">add</span>
            دراسة حالة جديدة
        </button>
    </div>

    <div class="adm-case-list">
        @foreach ($cases as $index => $case)
            @php($focusType = $case['focus_type'] ?? 'problem')
            <article class="adm-case-card adm-panel adm-panel--inner-glow" data-adm-case-card>
                <div class="adm-case-card__preview">
                    <x-ui.lazy-img :src="$case['image']" :alt="$case['image_alt']" />
                    <div class="adm-case-card__highlight">
                        <strong>{{ $case['highlight']['value'] }}</strong>
                        <span>{{ $case['highlight']['label'] }}</span>
                    </div>
                </div>

                <div class="adm-case-card__body">
                    <div class="adm-case-card__meta">
                        <x-admin.status-badge variant="primary">{{ $case['service_label'] }}</x-admin.status-badge>
                        <span>{{ $case['client'] }}</span>
                        <span>{{ $case['duration'] }}</span>
                    </div>

                    <h3>{{ $case['title'] }}</h3>

                    <div class="adm-case-card__stack">
                        @foreach ($case['stack'] as $tech)
                            <span class="adm-tag">{{ $tech }}</span>
                        @endforeach
                    </div>

                    <fieldset class="adm-focus-group" data-adm-case-focus>
                        <legend>نوع العرض</legend>
                        @foreach ($focusOptions as $value => $label)
                            <label class="adm-focus-option">
                                <input
                                    type="radio"
                                    name="focus_{{ $index }}"
                                    value="{{ $value }}"
                                    data-adm-focus-option
                                    @checked($focusType === $value)
                                >
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </fieldset>

                    <div class="adm-case-fields" data-adm-focus-problem @if($focusType !== 'problem') hidden @endif>
                        <label class="adm-field adm-field--full">
                            <span class="adm-field__label">المشكلة</span>
                            <textarea class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" readonly>{{ $case['problem'] ?? '' }}</textarea>
                        </label>
                        <label class="adm-field adm-field--full">
                            <span class="adm-field__label">الحل التقني</span>
                            <textarea class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" readonly>{{ $case['solution'] ?? '' }}</textarea>
                        </label>
                    </div>

                    <div class="adm-case-fields" data-adm-focus-goal @if($focusType !== 'goal') hidden @endif>
                        <label class="adm-field adm-field--full">
                            <span class="adm-field__label">الهدف</span>
                            <textarea class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" readonly>{{ $case['goal'] ?? '' }}</textarea>
                        </label>
                        <label class="adm-field adm-field--full">
                            <span class="adm-field__label">ما قمنا به</span>
                            <textarea class="adm-field__input adm-field__input--standalone adm-field__textarea" rows="3" readonly>{{ $case['actions_taken'] ?? '' }}</textarea>
                        </label>
                    </div>

                    <div class="adm-case-card__results">
                        @foreach ($case['results'] as $result)
                            <div class="adm-case-result">
                                <strong>{{ $result['value'] }}</strong>
                                <span>{{ $result['label'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="adm-case-card__actions">
                        <button type="button" class="adm-btn adm-btn--ghost adm-btn--sm">
                            <span class="material-symbols-outlined">edit</span>
                            تعديل
                        </button>
                        <a href="{{ route('projects') }}#case-studies" class="adm-btn adm-btn--ghost adm-btn--sm" target="_blank">
                            <span class="material-symbols-outlined">visibility</span>
                            معاينة
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection

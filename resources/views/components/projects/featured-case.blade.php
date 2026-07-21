@php($section = config('site.projects_page.case_studies'))

<section id="case-studies" class="projects-case" data-case-studies>
    <div class="a2z-container">
        <div class="projects-case__inner">
            <div class="projects-case__header">
                <span class="projects-case__badge">{{ $section['badge'] }}</span>
                <h2 class="projects-case__title">{{ $section['title'] }}</h2>
                @if (! empty($section['description']))
                    <p class="projects-case__description">{{ $section['description'] }}</p>
                @endif
            </div>

            <div class="projects-case__slider">
                @foreach ($section['items'] as $index => $case)
                    <article
                        class="projects-case__slide{{ $index === 0 ? ' projects-case__slide--active' : '' }}"
                        data-case-slide="{{ $index }}"
                        @if ($index !== 0) hidden @endif
                    >
                        <div class="projects-case__meta">
                            <span class="projects-case__service projects-case__service--{{ $case['service_type'] }}">
                                {{ $case['service_label'] }}
                            </span>
                            <span class="projects-case__client">{{ $case['client'] }}</span>
                            <span class="projects-case__duration">
                                <x-ui.icon name="schedule" size="sm" />
                                {{ $case['duration'] }}
                            </span>
                        </div>

                        <h3 class="projects-case__slide-title">{{ $case['title'] }}</h3>

                        <div class="projects-case__grid">
                            <div class="projects-case__visual">
                                <x-ui.lazy-img
                                    :src="$case['image']"
                                    :alt="$case['image_alt']"
                                    class="projects-case__image"
                                />
                                <div class="projects-case__highlight">
                                    <span class="projects-case__highlight-value">{{ $case['highlight']['value'] }}</span>
                                    <span class="projects-case__highlight-label">{{ $case['highlight']['label'] }}</span>
                                </div>
                            </div>

                            <div class="projects-case__content">
                                <div class="projects-case__stack">
                                    @foreach ($case['stack'] as $tech)
                                        <span class="projects-case__stack-tag">{{ $tech }}</span>
                                    @endforeach
                                </div>

                                <div class="projects-case__block">
                                    @php($focusType = $case['focus_type'] ?? 'problem')
                                    @if ($focusType === 'goal')
                                        <div class="projects-case__block-head">
                                            <span class="projects-case__icon projects-case__icon--gold">
                                                <x-ui.icon name="flag" />
                                            </span>
                                            <h4 class="projects-case__block-title">الهدف</h4>
                                        </div>
                                        <p class="projects-case__text">{{ $case['goal'] ?? '' }}</p>
                                    @else
                                        <div class="projects-case__block-head">
                                            <span class="projects-case__icon projects-case__icon--danger">
                                                <x-ui.icon name="error" />
                                            </span>
                                            <h4 class="projects-case__block-title">المشكلة</h4>
                                        </div>
                                        <p class="projects-case__text">{{ $case['problem'] }}</p>
                                    @endif
                                </div>

                                <div class="projects-case__block">
                                    @if ($focusType === 'goal')
                                        <div class="projects-case__block-head">
                                            <span class="projects-case__icon projects-case__icon--primary">
                                                <x-ui.icon name="task_alt" />
                                            </span>
                                            <h4 class="projects-case__block-title">ما قمنا به</h4>
                                        </div>
                                        <p class="projects-case__text">{{ $case['actions_taken'] ?? $case['solution'] }}</p>
                                    @else
                                        <div class="projects-case__block-head">
                                            <span class="projects-case__icon projects-case__icon--primary">
                                                <x-ui.icon name="integration_instructions" />
                                            </span>
                                            <h4 class="projects-case__block-title">الحل التقني</h4>
                                        </div>
                                        <p class="projects-case__text">{{ $case['solution'] }}</p>
                                    @endif
                                </div>

                                <div class="projects-case__results">
                                    @foreach ($case['results'] as $result)
                                        <div class="projects-case__result">
                                            <span class="projects-case__result-value">{{ $result['value'] }}</span>
                                            <span class="projects-case__result-label">{{ $result['label'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="projects-case__pagination">
                <button
                    type="button"
                    class="projects-case__nav-btn"
                    data-case-prev
                    aria-label="دراسة الحالة السابقة"
                >
                    <x-ui.icon name="chevron_right" />
                </button>

                <div class="projects-case__pagination-center">
                    <div class="projects-case__dots" data-case-dots>
                        @foreach ($section['items'] as $index => $case)
                            <button
                                type="button"
                                class="projects-case__dot{{ $index === 0 ? ' projects-case__dot--active' : '' }}"
                                data-case-dot="{{ $index }}"
                                aria-label="دراسة حالة {{ $index + 1 }}: {{ $case['title'] }}"
                            ></button>
                        @endforeach
                    </div>
                    <span class="projects-case__counter" data-case-counter>1 / {{ count($section['items']) }}</span>
                </div>

                <button
                    type="button"
                    class="projects-case__nav-btn"
                    data-case-next
                    aria-label="دراسة الحالة التالية"
                >
                    <x-ui.icon name="chevron_left" />
                </button>
            </div>
        </div>
    </div>
</section>

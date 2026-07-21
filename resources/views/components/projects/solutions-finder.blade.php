@php($finder = config('site.projects_page.solutions_finder'))

<section id="solutions-finder" class="solutions-finder">
    <div class="a2z-container">
        <div class="solutions-finder__header">
            <h2 class="solutions-finder__title">{{ $finder['title'] }}</h2>
            <p class="solutions-finder__description">{{ $finder['description'] }}</p>
        </div>

        <div
            class="solutions-finder__layout"
            data-solutions-finder
            data-services-map='@json($finder['services_map'], JSON_UNESCAPED_UNICODE)'
            data-services-href="{{ $finder['services_href'] }}"
            data-quote-href="{{ $finder['quote_href'] }}"
        >
            <div class="solutions-finder__wizard">
                <div class="solutions-finder__progress" data-finder-progress>
                    @foreach ($finder['steps'] as $index => $step)
                        <div class="solutions-finder__progress-item{{ $index === 0 ? ' solutions-finder__progress-item--active' : '' }}" data-finder-progress-item="{{ $index }}">
                            <span class="solutions-finder__progress-dot">{{ $index + 1 }}</span>
                            <span class="solutions-finder__progress-label">{{ $step['question'] }}</span>
                        </div>
                    @endforeach
                </div>

                @foreach ($finder['steps'] as $index => $step)
                    <div
                        class="solutions-finder__step{{ $index === 0 ? ' solutions-finder__step--active' : '' }}"
                        data-finder-step="{{ $index }}"
                    >
                        <h3 class="solutions-finder__question">{{ $step['question'] }}</h3>

                        <div class="solutions-finder__options">
                            @foreach ($step['options'] as $option)
                                <button
                                    type="button"
                                    class="solutions-finder__option"
                                    data-finder-option
                                    data-step="{{ $index }}"
                                    data-scores='@json($option['scores'], JSON_UNESCAPED_UNICODE)'
                                >
                                    <span class="solutions-finder__option-icon">
                                        <x-ui.icon :name="$option['icon']" />
                                    </span>
                                    <span class="solutions-finder__option-label">{{ $option['label'] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="solutions-finder__step solutions-finder__step--result" data-finder-result hidden>
                    <h3 class="solutions-finder__question">الحلول المقترحة لك</h3>
                    <p class="solutions-finder__result-intro">بناءً على إجاباتك، نوصي بالخدمات التالية:</p>
                    <div class="solutions-finder__results" data-finder-results></div>
                    <div class="solutions-finder__result-actions">
                        <x-ui.button variant="gold" size="lg" :href="$finder['services_href']">
                            عرض الخدمات
                        </x-ui.button>
                        <x-ui.button variant="outline-teal" size="lg" :href="$finder['quote_href']">
                            طلب عرض سعر
                        </x-ui.button>
                    </div>
                    <button type="button" class="solutions-finder__restart" data-finder-restart>
                        <x-ui.icon name="refresh" size="sm" />
                        ابدأ من جديد
                    </button>
                </div>
            </div>

            <aside class="solutions-finder__aside">
                <div class="solutions-finder__aside-card">
                    <span class="solutions-finder__aside-icon">
                        <x-ui.icon name="travel_explore" />
                    </span>
                    <h4 class="solutions-finder__aside-title">كيف يعمل المستكشف؟</h4>
                    <ul class="solutions-finder__aside-list">
                        <li>يحلل هدفك وحجم مؤسستك وأولوياتك</li>
                        <li>يقترح الخدمات الأنسب من محفظتنا</li>
                        <li>يوجهك مباشرة لطلب عرض السعر</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

@php($calc = config('site.projects_page.calculator'))

<section id="cost-calculator" class="cost-calculator">
    <div class="a2z-container">
        <div class="cost-calculator__header">
            <h2 class="cost-calculator__title">{{ $calc['title'] }}</h2>
            <p class="cost-calculator__description">{{ $calc['description'] }}</p>
        </div>

        <div
            class="cost-calculator__layout"
            data-cost-calculator
            data-service-types='@json($calc['service_types'], JSON_UNESCAPED_UNICODE)'
            data-features='@json($calc['features'], JSON_UNESCAPED_UNICODE)'
            data-scales='@json($calc['scales'], JSON_UNESCAPED_UNICODE)'
        >
            <div class="cost-calculator__main">
                <div class="cost-calculator__stepper" data-calc-stepper>
                    <div class="cost-calculator__step-node cost-calculator__step-node--active" data-calc-node="1">1</div>
                    <div class="cost-calculator__step-line" data-calc-line="1"></div>
                    <div class="cost-calculator__step-node" data-calc-node="2">2</div>
                    <div class="cost-calculator__step-line" data-calc-line="2"></div>
                    <div class="cost-calculator__step-node" data-calc-node="3">3</div>
                </div>

                <div class="cost-calculator__panel cost-calculator__panel--active" data-calc-step="1">
                    <h3 class="cost-calculator__step-title">ما نوع الخدمة التي تحتاجها؟</h3>
                    <p class="cost-calculator__step-desc">اختر نوع الخدمة لنبدأ في تقدير التكلفة التقريبية.</p>

                    <div class="cost-calculator__type-grid">
                        @foreach ($calc['service_types'] as $type)
                            <button
                                type="button"
                                class="cost-calculator__type-card"
                                data-calc-type
                                data-slug="{{ $type['slug'] }}"
                                data-title="{{ $type['title'] }}"
                                data-base-price="{{ $type['base_price'] }}"
                            >
                                <span class="cost-calculator__type-icon">
                                    <x-ui.icon :name="$type['icon']" />
                                </span>
                                <span class="cost-calculator__type-name">{{ $type['title'] }}</span>
                                <span class="cost-calculator__type-desc">{{ $type['description'] }}</span>
                                <span class="cost-calculator__type-price">يبدأ من ${{ number_format($type['base_price']) }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="cost-calculator__panel" data-calc-step="2" hidden>
                    <h3 class="cost-calculator__step-title">ما الميزات الإضافية المطلوبة؟</h3>
                    <p class="cost-calculator__step-desc">حدد الخصائص التقنية التي يحتاجها مشروعك.</p>

                    <div class="cost-calculator__features">
                        @foreach ($calc['features'] as $feature)
                            <label class="cost-calculator__feature">
                                <input
                                    type="checkbox"
                                    class="cost-calculator__feature-input"
                                    data-calc-feature
                                    data-feature-id="{{ $feature['id'] }}"
                                    data-feature-title="{{ $feature['title'] }}"
                                    data-feature-price="{{ $feature['price'] }}"
                                >
                                <span class="cost-calculator__feature-content">
                                    <span class="cost-calculator__feature-title">{{ $feature['title'] }}</span>
                                    <span class="cost-calculator__feature-desc">{{ $feature['description'] }}</span>
                                </span>
                                <span class="cost-calculator__feature-price">+${{ number_format($feature['price']) }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="cost-calculator__nav">
                        <button type="button" class="cost-calculator__nav-btn cost-calculator__nav-btn--ghost" data-calc-prev>
                            السابق
                        </button>
                        <button type="button" class="cost-calculator__nav-btn cost-calculator__nav-btn--primary" data-calc-next>
                            المتابعة
                        </button>
                    </div>
                </div>

                <div class="cost-calculator__panel" data-calc-step="3" hidden>
                    <h3 class="cost-calculator__step-title">ما الحجم المقدر للمشروع؟</h3>
                    <p class="cost-calculator__step-desc">حجم المشروع يؤثر على البنية التحتية وقابلية التوسع.</p>

                    <div class="cost-calculator__scales">
                        @foreach ($calc['scales'] as $scale)
                            <button
                                type="button"
                                class="cost-calculator__scale-btn"
                                data-calc-scale
                                data-scale-slug="{{ $scale['slug'] }}"
                                data-scale-title="{{ $scale['title'] }}"
                                data-scale-multiplier="{{ $scale['multiplier'] }}"
                            >
                                <span class="cost-calculator__scale-icon">
                                    <x-ui.icon :name="$scale['icon']" />
                                </span>
                                <span class="cost-calculator__scale-content">
                                    <span class="cost-calculator__scale-title">{{ $scale['title'] }}</span>
                                    <span class="cost-calculator__scale-desc">{{ $scale['description'] }}</span>
                                </span>
                                <span class="cost-calculator__scale-mult">x{{ $scale['multiplier'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="cost-calculator__nav">
                        <button type="button" class="cost-calculator__nav-btn cost-calculator__nav-btn--ghost" data-calc-prev>
                            السابق
                        </button>
                    </div>
                </div>
            </div>

            <aside class="cost-calculator__summary">
                <div class="cost-calculator__summary-card">
                    <h3 class="cost-calculator__summary-title">
                        <x-ui.icon name="receipt_long" />
                        ملخص التكلفة
                    </h3>

                    <dl class="cost-calculator__summary-list">
                        <div class="cost-calculator__summary-row">
                            <dt>نوع الخدمة</dt>
                            <dd data-calc-summary-type>—</dd>
                        </div>
                        <div class="cost-calculator__summary-row">
                            <dt>عدد الميزات</dt>
                            <dd data-calc-summary-features>0</dd>
                        </div>
                        <div class="cost-calculator__summary-row">
                            <dt>عامل الحجم</dt>
                            <dd data-calc-summary-scale>—</dd>
                        </div>
                    </dl>

                    <div class="cost-calculator__total">
                        <span class="cost-calculator__total-label">الإجمالي التقريبي</span>
                        <span class="cost-calculator__total-value" data-calc-total>$0</span>
                        <p class="cost-calculator__total-note">{{ $calc['disclaimer'] }}</p>
                    </div>

                    <div class="cost-calculator__summary-actions">
                        <x-ui.button variant="gold" class="cost-calculator__summary-btn" :href="$calc['quote_cta']['href']">
                            {{ $calc['quote_cta']['label'] }}
                        </x-ui.button>
                        <x-ui.button variant="outline-teal" class="cost-calculator__summary-btn" :href="$calc['services_cta']['href']">
                            {{ $calc['services_cta']['label'] }}
                        </x-ui.button>
                    </div>

                    <div class="cost-calculator__trust">
                        <x-ui.icon name="verified" color="teal" />
                        <p>يتضمن التقدير ضمان جودة ودعم فني متواصل بعد التسليم.</p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

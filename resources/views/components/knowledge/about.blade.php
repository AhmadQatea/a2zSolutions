@php($about = config('site.knowledge_page.about'))

<section id="about" class="knowledge-about">
    <div class="a2z-container">
        <div class="knowledge-about__grid">
            <div class="knowledge-about__visual">
                <x-ui.lazy-img
                    :src="$about['image']"
                    :alt="$about['image_alt']"
                    class="knowledge-about__image"
                />
                <div class="knowledge-about__stats">
                    @foreach ($about['stats'] as $stat)
                        <div class="knowledge-about__stat">
                            <span class="knowledge-about__stat-value">{{ $stat['value'] }}</span>
                            <span class="knowledge-about__stat-label">{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="knowledge-about__content">
                <span class="knowledge-about__badge">{{ $about['badge'] }}</span>
                <h2 class="knowledge-about__title">{{ $about['title'] }}</h2>
                <p class="knowledge-about__description">{{ $about['description'] }}</p>

                <div class="knowledge-about__blocks">
                    <div class="knowledge-about__block">
                        <h3 class="knowledge-about__block-title">رسالتنا</h3>
                        <p class="knowledge-about__block-text">{{ $about['mission'] }}</p>
                    </div>
                    <div class="knowledge-about__block">
                        <h3 class="knowledge-about__block-title">رؤيتنا</h3>
                        <p class="knowledge-about__block-text">{{ $about['vision'] }}</p>
                    </div>
                </div>

                <div class="knowledge-about__values">
                    @foreach ($about['values'] as $value)
                        <div class="knowledge-about__value">
                            <span class="knowledge-about__value-icon">
                                <x-ui.icon :name="$value['icon']" color="teal" />
                            </span>
                            <div>
                                <h4 class="knowledge-about__value-title">{{ $value['title'] }}</h4>
                                <p class="knowledge-about__value-desc">{{ $value['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

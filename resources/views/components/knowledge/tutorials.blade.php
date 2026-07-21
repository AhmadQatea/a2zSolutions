@php($tutorials = config('site.knowledge_page.tutorials'))

<section id="tutorials" class="knowledge-tutorials">
    <div class="a2z-container">
        <div class="knowledge-tutorials__header">
            <h2 class="knowledge-tutorials__title">{{ $tutorials['title'] }}</h2>
            <p class="knowledge-tutorials__description">{{ $tutorials['description'] }}</p>
        </div>

        <div class="knowledge-tutorials__grid">
            @foreach ($tutorials['items'] as $tutorial)
                <article class="knowledge-tutorial">
                    <div class="knowledge-tutorial__head">
                        <span class="knowledge-tutorial__icon">
                            <x-ui.icon :name="$tutorial['icon']" color="teal" />
                        </span>
                        <div class="knowledge-tutorial__meta">
                            <span class="knowledge-tutorial__level">{{ $tutorial['level'] }}</span>
                            <span class="knowledge-tutorial__duration">{{ $tutorial['duration'] }}</span>
                        </div>
                    </div>

                    <h3 class="knowledge-tutorial__title">{{ $tutorial['title'] }}</h3>
                    <p class="knowledge-tutorial__excerpt">{{ $tutorial['excerpt'] }}</p>

                    <ol class="knowledge-tutorial__steps">
                        @foreach ($tutorial['steps'] as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ol>
                </article>
            @endforeach
        </div>
    </div>
</section>

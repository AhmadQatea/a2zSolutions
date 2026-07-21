@php($projects = config('site.projects'))

<section id="projects" class="a2z-projects">
    <div class="a2z-container">
        <div class="a2z-projects__header">
            <div>
                <h2 class="a2z-projects__title">{{ $projects['title'] }}</h2>
                <p class="a2z-projects__description">{{ $projects['description'] }}</p>
            </div>

            <x-ui.button variant="outline-navy" :href="$projects['view_all_href'] ?? '/projects'">
                {{ $projects['view_all_label'] }}
            </x-ui.button>
        </div>

        <div class="a2z-projects__grid">
            @foreach ($projects['items'] as $project)
                <x-ui.project-card
                    :image="$project['image']"
                    :image-alt="$project['image_alt']"
                    :category="$project['category']"
                    :category-variant="$project['category_variant']"
                    :title="$project['title']"
                    :description="$project['description']"
                />
            @endforeach
        </div>
    </div>
</section>

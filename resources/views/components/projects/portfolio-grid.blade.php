@php($page = config('site.projects_page'))

<section id="portfolio" class="projects-portfolio">
    <div class="a2z-container">
        <div class="projects-portfolio__header">
            <div>
                <h2 class="projects-portfolio__title">{{ $page['portfolio']['title'] }}</h2>
                <p class="projects-portfolio__description">{{ $page['portfolio']['description'] }}</p>
            </div>
        </div>

        <div class="projects-portfolio__filters" data-project-filters>
            @foreach ($page['filters'] as $filter)
                <button
                    type="button"
                    class="projects-portfolio__filter{{ $filter['slug'] === 'all' ? ' projects-portfolio__filter--active' : '' }}"
                    data-project-filter="{{ $filter['slug'] }}"
                >
                    {{ $filter['label'] }}
                </button>
            @endforeach
        </div>

        <div class="projects-portfolio__grid" data-project-grid>
            @foreach ($page['items'] as $project)
                <x-ui.portfolio-card
                    :service-type="$project['service_type']"
                    :image="$project['image']"
                    :image-alt="$project['image_alt']"
                    :tags="$project['tags']"
                    :title="$project['title']"
                    :description="$project['description']"
                />
            @endforeach
        </div>
    </div>
</section>

@php($page = config('site.projects_page'))

<section class="projects-hero">
    <div class="projects-hero__glow projects-hero__glow--top" aria-hidden="true"></div>
    <div class="projects-hero__glow projects-hero__glow--bottom" aria-hidden="true"></div>

    <div class="a2z-container projects-hero__inner">
        <span class="projects-hero__badge">{{ $page['hero']['badge'] }}</span>
        <h1 class="projects-hero__title">{{ $page['hero']['title'] }}</h1>
        <p class="projects-hero__description">{{ $page['hero']['description'] }}</p>

        <div class="projects-hero__actions">
            <x-ui.button variant="gold" size="lg" href="#portfolio">
                استكشف المشاريع
            </x-ui.button>
            <x-ui.button variant="outline-teal" size="lg" href="#solutions-finder">
                مستكشف الحلول
            </x-ui.button>
        </div>
    </div>
</section>

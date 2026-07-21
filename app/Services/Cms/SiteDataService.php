<?php

namespace App\Services\Cms;

use App\Enums\BlogPostStatus;
use App\Models\BlogPost;
use App\Models\CalculatorFeature;
use App\Models\CaseStudy;
use App\Models\Faq;
use App\Models\LegalPage;
use App\Models\Project;
use App\Models\ProjectScale;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\Tutorial;
use App\Support\MediaPath;
use Illuminate\Support\Facades\Cache;

class SiteDataService
{
    private const CACHE_KEY = 'cms.site.runtime_config';

    private const CACHE_TTL_SECONDS = 3600;

    public function hydrateRuntimeConfig(): void
    {
        if ($this->shouldSkipHydration()) {
            return;
        }

        $runtime = Cache::remember(self::CACHE_KEY, self::CACHE_TTL_SECONDS, function (): array {
            if (! $this->databaseHasCmsData()) {
                return [];
            }

            return $this->buildSiteOverrides();
        });

        if ($runtime !== []) {
            config(['site' => array_replace_recursive(config('site'), $runtime)]);
        }
    }

    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * @return array<string, mixed>
     */
    public function buildSiteOverrides(): array
    {
        $settings = $this->settingsByGroup();

        return [
            'name' => $settings['brand']['name'] ?? config('site.name'),
            'name_ar' => $settings['brand']['name_ar'] ?? config('site.name_ar'),
            'tagline' => $settings['brand']['tagline'] ?? config('site.tagline'),
            'contact' => $this->buildContact($settings),
            'social' => $this->buildSocial(),
            'hero' => $this->buildHero($settings),
            'services' => $this->buildHomeServicesSection(),
            'why_choose_us' => $this->buildWhyChooseUs($settings),
            'projects' => $this->buildHomeProjectsSection(),
            'cta' => $this->buildCta($settings),
            'services_page' => $this->buildServicesPage($settings),
            'projects_page' => $this->buildProjectsPage($settings),
            'contact_page' => $this->buildContactPage($settings),
            'knowledge_page' => $this->buildKnowledgePage($settings),
            'legal_pages' => $this->buildLegalPages(),
        ];
    }

    public function databaseHasCmsData(): bool
    {
        return Service::query()->exists()
            || Project::query()->exists()
            || SiteSetting::query()->exists();
    }

    private function shouldSkipHydration(): bool
    {
        return app()->runningInConsole() && ! app()->runningUnitTests();
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function settingsByGroup(): array
    {
        return SiteSetting::query()
            ->get(['group', 'key', 'value'])
            ->groupBy('group')
            ->map(fn ($rows) => $rows->pluck('value', 'key')->all())
            ->all();
    }

    /**
     * @param  array<string, array<string, string>>  $settings
     * @return array<string, mixed>
     */
    private function buildContact(array $settings): array
    {
        $contact = config('site.contact');

        if (isset($settings['contact'])) {
            $contact = array_replace_recursive($contact, array_filter($settings['contact']));
        }

        if (isset($settings['contact']['lat'], $settings['contact']['lng'])) {
            $contact['coordinates'] = [
                'lat' => (float) $settings['contact']['lat'],
                'lng' => (float) $settings['contact']['lng'],
            ];
        }

        return $contact;
    }

    /**
     * @return list<array<string, string>>
     */
    private function buildSocial(): array
    {
        $links = SocialLink::query()->published()->ordered()->get(['label', 'icon', 'href']);

        if ($links->isEmpty()) {
            return config('site.social');
        }

        return $links->map(fn (SocialLink $link): array => [
            'label' => $link->label,
            'icon' => $link->icon ?? 'link',
            'href' => $link->href,
        ])->all();
    }

    /**
     * @param  array<string, array<string, string>>  $settings
     * @return array<string, mixed>
     */
    private function buildHero(array $settings): array
    {
        $hero = config('site.hero');

        if (isset($settings['hero'])) {
            $hero = array_replace($hero, array_filter($settings['hero']));
        }

        if (isset($hero['image_path'])) {
            $hero['image'] = MediaPath::url($hero['image_path']);
            unset($hero['image_path']);
        }

        return $hero;
    }

    /**
     * @return array<string, mixed>
     */
    private function buildHomeServicesSection(): array
    {
        $section = config('site.services');
        $services = Service::query()
            ->published()
            ->where('show_on_home', true)
            ->ordered()
            ->get(['icon', 'icon_variant', 'title', 'description']);

        if ($services->isEmpty()) {
            return $section;
        }

        $section['items'] = $services->map(fn (Service $service): array => [
            'icon' => $service->icon,
            'icon_variant' => $service->icon_variant,
            'title' => $service->title,
            'description' => $service->description,
        ])->all();

        return $section;
    }

    /**
     * @param  array<string, array<string, string>>  $settings
     * @return array<string, mixed>
     */
    private function buildWhyChooseUs(array $settings): array
    {
        $section = config('site.why_choose_us');

        if (isset($settings['why_choose_us'])) {
            $stored = $settings['why_choose_us'];
            $section['title'] = $stored['title'] ?? $section['title'];
            $section['description'] = $stored['description'] ?? $section['description'];
        }

        return $section;
    }

    /**
     * @return array<string, mixed>
     */
    private function buildHomeProjectsSection(): array
    {
        $section = config('site.projects');
        $projects = Project::query()
            ->published()
            ->featured()
            ->with('service:id,slug,title')
            ->orderBy('featured_order')
            ->limit(3)
            ->get(['id', 'service_id', 'title', 'description', 'image_path', 'image_alt']);

        if ($projects->isEmpty()) {
            return $section;
        }

        $section['items'] = $projects->map(fn (Project $project): array => [
            'image' => $project->imageUrl(),
            'image_alt' => $project->image_alt,
            'category' => $project->service?->title ?? '',
            'category_variant' => $this->serviceVariant($project->service?->slug),
            'title' => $project->title,
            'description' => $project->description,
        ])->all();

        return $section;
    }

    /**
     * @param  array<string, array<string, string>>  $settings
     * @return array<string, mixed>
     */
    private function buildCta(array $settings): array
    {
        $cta = config('site.cta');

        if (isset($settings['cta'])) {
            $cta = array_replace($cta, array_filter($settings['cta']));
        }

        return $cta;
    }

    /**
     * @param  array<string, array<string, string>>  $settings
     * @return array<string, mixed>
     */
    private function buildServicesPage(array $settings): array
    {
        $page = config('site.services_page');
        $services = Service::query()
            ->published()
            ->where('show_on_services_page', true)
            ->ordered()
            ->get();

        if ($services->isNotEmpty()) {
            $page['bento']['items'] = $services->map(fn (Service $service): array => [
                'layout' => $service->layout ?? 'standard',
                'icon' => $service->icon,
                'icon_variant' => $service->icon_variant,
                'decor_icon' => $service->decor_icon,
                'title' => $service->title,
                'description' => $service->long_description ?? $service->description,
                'features' => $service->features,
                'link_label' => $service->link_label,
                'href' => $service->href,
                'image' => $service->imageUrl(),
                'image_alt' => $service->image_alt,
            ])->all();
        }

        $faqs = Faq::query()->published()->ordered()->get(['question', 'answer']);
        if ($faqs->isNotEmpty()) {
            $page['faq']['items'] = $faqs->map(fn (Faq $faq): array => [
                'question' => $faq->question,
                'answer' => $faq->answer,
            ])->all();
        }

        if (isset($settings['services_page']['meta_description'])) {
            $page['meta_description'] = $settings['services_page']['meta_description'];
        }

        return $page;
    }

    /**
     * @param  array<string, array<string, string>>  $settings
     * @return array<string, mixed>
     */
    private function buildProjectsPage(array $settings): array
    {
        $page = config('site.projects_page');

        $projects = Project::query()
            ->published()
            ->with('service:id,slug,title')
            ->ordered()
            ->get();

        if ($projects->isNotEmpty()) {
            $page['items'] = $projects->map(fn (Project $project): array => [
                'service_type' => $project->service?->slug,
                'featured' => $project->is_featured,
                'image' => $project->imageUrl(),
                'image_alt' => $project->image_alt,
                'tags' => $project->tags ?? [],
                'title' => $project->title,
                'description' => $project->description,
            ])->all();
        }

        $cases = CaseStudy::query()
            ->published()
            ->with('service:id,slug,title')
            ->ordered()
            ->get();

        if ($cases->isNotEmpty()) {
            $page['case_studies']['items'] = $cases->map(fn (CaseStudy $case): array => [
                'service_type' => $case->service?->slug,
                'service_label' => $case->service?->title,
                'focus_type' => $case->focus_type->value,
                'client' => $case->client,
                'duration' => $case->duration,
                'stack' => $case->stack ?? [],
                'title' => $case->title,
                'image' => $case->imageUrl(),
                'image_alt' => $case->image_alt,
                'highlight' => [
                    'value' => $case->highlight_value,
                    'label' => $case->highlight_label,
                ],
                'problem' => $case->problem,
                'solution' => $case->solution,
                'goal' => $case->goal,
                'actions_taken' => $case->actions_taken,
                'results' => $case->results ?? [],
            ])->all();
        }

        $features = CalculatorFeature::query()->active()->ordered()->get();
        if ($features->isNotEmpty()) {
            $page['calculator']['features'] = $features->map(fn (CalculatorFeature $feature): array => [
                'id' => $feature->slug,
                'title' => $feature->title,
                'description' => $feature->description,
                'price' => $feature->price,
            ])->all();
        }

        $scales = ProjectScale::query()->active()->ordered()->get();
        if ($scales->isNotEmpty()) {
            $page['calculator']['service_types'] = Service::query()
                ->published()
                ->ordered()
                ->get(['slug', 'icon', 'title', 'description', 'base_price'])
                ->map(fn (Service $service): array => [
                    'slug' => $service->slug,
                    'icon' => $service->icon,
                    'title' => $service->title,
                    'description' => $service->description,
                    'base_price' => $service->base_price,
                ])->all();

            $page['calculator']['scales'] = $scales->map(fn (ProjectScale $scale): array => [
                'slug' => $scale->slug,
                'icon' => $scale->icon,
                'title' => $scale->title,
                'description' => $scale->description,
                'multiplier' => (float) $scale->multiplier,
            ])->all();
        }

        if (isset($settings['projects_page']['meta_description'])) {
            $page['meta_description'] = $settings['projects_page']['meta_description'];
        }

        return $page;
    }

    /**
     * @param  array<string, array<string, string>>  $settings
     * @return array<string, mixed>
     */
    private function buildContactPage(array $settings): array
    {
        $page = config('site.contact_page');

        if (isset($settings['contact_page']['meta_description'])) {
            $page['meta_description'] = $settings['contact_page']['meta_description'];
        }

        return $page;
    }

    /**
     * @param  array<string, array<string, string>>  $settings
     * @return array<string, mixed>
     */
    private function buildKnowledgePage(array $settings): array
    {
        $page = config('site.knowledge_page');

        $posts = BlogPost::query()
            ->where('status', BlogPostStatus::Published)
            ->orderByDesc('published_at')
            ->get(['title', 'category', 'excerpt', 'image_path', 'image_alt', 'read_time_minutes', 'published_at']);

        if ($posts->isNotEmpty()) {
            $page['blog']['posts'] = $posts->map(fn (BlogPost $post): array => [
                'title' => $post->title,
                'category' => $post->category,
                'date' => $post->published_at?->translatedFormat('d F Y') ?? '',
                'read_time' => $post->read_time_minutes.' دقائق',
                'excerpt' => $post->excerpt,
                'image' => $post->imageUrl(),
                'image_alt' => $post->image_alt,
            ])->all();
        }

        $tutorials = Tutorial::query()->published()->ordered()->get();
        if ($tutorials->isNotEmpty()) {
            $page['tutorials']['items'] = $tutorials->map(fn (Tutorial $tutorial): array => [
                'icon' => $tutorial->icon,
                'title' => $tutorial->title,
                'level' => $tutorial->level,
                'duration' => $tutorial->duration,
                'steps' => $tutorial->steps,
                'excerpt' => $tutorial->excerpt,
            ])->all();
        }

        if (isset($settings['knowledge_page']['meta_description'])) {
            $page['meta_description'] = $settings['knowledge_page']['meta_description'];
        }

        if (isset($settings['about'])) {
            $about = $page['about'];
            $stored = $settings['about'];
            $about['title'] = $stored['title'] ?? $about['title'];
            $about['description'] = $stored['description'] ?? $about['description'];
            $about['mission'] = $stored['mission'] ?? $about['mission'];
            $about['vision'] = $stored['vision'] ?? $about['vision'];
            if (isset($stored['image_path'])) {
                $about['image'] = MediaPath::url($stored['image_path']);
            }
            $page['about'] = $about;
        }

        return $page;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function buildLegalPages(): array
    {
        $pages = LegalPage::query()->published()->get(['slug', 'title', 'content', 'updated_at']);

        if ($pages->isEmpty()) {
            return config('site.legal_pages');
        }

        return $pages->mapWithKeys(fn (LegalPage $page): array => [
            $page->slug => [
                'title' => $page->title,
                'updated_at' => $page->updated_at?->translatedFormat('d F Y'),
                'content' => $page->content,
            ],
        ])->all();
    }

    private function serviceVariant(?string $slug): string
    {
        return match ($slug) {
            'erp', 'hosting' => 'teal',
            'uiux', 'systems' => 'gold',
            default => 'gold',
        };
    }
}

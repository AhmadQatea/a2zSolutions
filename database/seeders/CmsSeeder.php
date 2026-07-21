<?php

namespace Database\Seeders;

use App\Enums\BlogPostStatus;
use App\Enums\CaseStudyFocusType;
use App\Enums\ChangelogEntryType;
use App\Enums\ConsultationBookingStatus;
use App\Enums\ContactMessageStatus;
use App\Models\Admin;
use App\Models\BlogPost;
use App\Models\BookingSlot;
use App\Models\CalculatorFeature;
use App\Models\CaseStudy;
use App\Models\ChangelogEntry;
use App\Models\ConsultationBooking;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\LegalPage;
use App\Models\ProjectScale;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    /**
     * @var array<int, string>
     */
    private array $serviceSlugs = ['web-dev', 'erp', 'uiux', 'ecommerce', 'hosting', 'systems'];

    public function run(): void
    {
        $this->seedSiteSettings();
        $this->seedSocialLinks();
        $serviceIds = $this->seedServices();
        $this->seedCaseStudies($serviceIds);
        $this->seedBlogPosts();
        $this->seedTutorials();
        $this->seedLegalPages();
        $this->seedFaqs();
        $this->seedCalculator();
        $this->seedBookingSlots();
        $this->seedContactMessages();
        $this->seedConsultationBookings();
        $this->seedChangelog();
        $this->seedAdmin();
    }

    private function seedSiteSettings(): void
    {
        $pairs = [
            ['brand', 'name', config('site.name')],
            ['brand', 'name_ar', config('site.name_ar')],
            ['brand', 'tagline', config('site.tagline')],
            ['contact', 'email', config('site.contact.email')],
            ['contact', 'phone', config('site.contact.phone')],
            ['contact', 'whatsapp', config('site.contact.whatsapp')],
            ['contact', 'location', config('site.contact.location')],
            ['contact', 'lat', (string) config('site.contact.coordinates.lat')],
            ['contact', 'lng', (string) config('site.contact.coordinates.lng')],
            ['hero', 'badge', config('site.hero.badge')],
            ['hero', 'title', config('site.hero.title')],
            ['hero', 'title_highlight', config('site.hero.title_highlight')],
            ['hero', 'title_suffix', config('site.hero.title_suffix')],
            ['hero', 'description', config('site.hero.description')],
            ['hero', 'image_path', config('site.hero.image')],
            ['hero', 'image_alt', config('site.hero.image_alt')],
            ['why_choose_us', 'title', config('site.why_choose_us.title')],
            ['why_choose_us', 'description', config('site.why_choose_us.description')],
            ['cta', 'title', config('site.cta.title')],
            ['cta', 'title_highlight', config('site.cta.title_highlight')],
            ['cta', 'description', config('site.cta.description')],
            ['cta', 'button_label', config('site.cta.button_label')],
            ['about', 'title', config('site.knowledge_page.about.title')],
            ['about', 'description', config('site.knowledge_page.about.description')],
            ['about', 'mission', config('site.knowledge_page.about.mission')],
            ['about', 'vision', config('site.knowledge_page.about.vision')],
            ['about', 'image_path', config('site.knowledge_page.about.image')],
            ['about', 'image_alt', config('site.knowledge_page.about.image_alt')],
            ['seo', 'home_description', config('site.hero.description')],
            ['seo', 'services_description', config('site.services_page.meta_description')],
            ['seo', 'projects_description', config('site.projects_page.meta_description')],
            ['seo', 'contact_description', config('site.contact_page.meta_description')],
            ['seo', 'knowledge_description', config('site.knowledge_page.meta_description')],
        ];

        foreach ($pairs as [$group, $key, $value]) {
            SiteSetting::query()->updateOrCreate(
                ['group' => $group, 'key' => $key],
                ['value' => $value]
            );
        }
    }

    private function seedSocialLinks(): void
    {
        foreach (config('site.social') as $index => $link) {
            SocialLink::query()->updateOrCreate(
                ['label' => $link['label']],
                [
                    'icon' => $link['icon'],
                    'href' => $link['href'],
                    'sort_order' => $index,
                    'is_published' => true,
                ]
            );
        }
    }

    /**
     * @return array<string, int>
     */
    private function seedServices(): array
    {
        $homeItems = config('site.services.items');
        $bentoItems = collect(config('site.services_page.bento.items'))->keyBy('title');
        $calculatorTypes = collect(config('site.projects_page.calculator.service_types'))->keyBy('slug');
        $ids = [];

        foreach ($this->serviceSlugs as $index => $slug) {
            $home = $homeItems[$index] ?? null;
            $bento = $bentoItems->first(fn ($item, $title) => $this->guessSlug($title) === $slug || ($home && $title === $home['title']));
            if (! $bento && $home) {
                $bento = $bentoItems->firstWhere('title', $home['title']);
            }

            $calc = $calculatorTypes->get($slug);
            $title = $bento['title'] ?? $home['title'] ?? $calc['title'] ?? $slug;

            $service = Service::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'icon' => $bento['icon'] ?? $home['icon'] ?? $calc['icon'] ?? 'code',
                    'icon_variant' => $bento['icon_variant'] ?? $home['icon_variant'] ?? 'navy',
                    'title' => $title,
                    'description' => $home['description'] ?? $bento['description'] ?? '',
                    'long_description' => $bento['description'] ?? null,
                    'layout' => $bento['layout'] ?? 'standard',
                    'decor_icon' => $bento['decor_icon'] ?? null,
                    'link_label' => $bento['link_label'] ?? null,
                    'href' => $bento['href'] ?? null,
                    'features' => $bento['features'] ?? null,
                    'image_path' => $this->extractImagePath($bento['image'] ?? null),
                    'image_alt' => $bento['image_alt'] ?? null,
                    'base_price' => $calc['base_price'] ?? null,
                    'sort_order' => $index,
                    'is_published' => true,
                    'show_on_home' => $home !== null,
                    'show_on_services_page' => $bento !== null,
                ]
            );

            $ids[$slug] = $service->id;
        }

        return $ids;
    }

    /**
     * @param  array<string, int>  $serviceIds
     */


    /**
     * @param  array<string, int>  $serviceIds
     */
    private function seedCaseStudies(array $serviceIds): void
    {
        foreach (config('site.projects_page.case_studies.items') as $index => $item) {
            CaseStudy::query()->updateOrCreate(
                ['title' => $item['title']],
                [
                    'service_id' => $serviceIds[$item['service_type']] ?? null,
                    'focus_type' => CaseStudyFocusType::from($item['focus_type'] ?? 'problem'),
                    'client' => $item['client'],
                    'duration' => $item['duration'],
                    'image_path' => $this->extractImagePath($item['image']),
                    'image_alt' => $item['image_alt'],
                    'highlight_value' => $item['highlight']['value'],
                    'highlight_label' => $item['highlight']['label'],
                    'problem' => $item['problem'] ?? null,
                    'solution' => $item['solution'] ?? null,
                    'goal' => $item['goal'] ?? null,
                    'actions_taken' => $item['actions_taken'] ?? null,
                    'stack' => $item['stack'] ?? [],
                    'results' => $item['results'] ?? [],
                    'sort_order' => $index,
                    'is_published' => true,
                ]
            );
        }
    }

    private function seedBlogPosts(): void
    {
        foreach (config('site.knowledge_page.blog.posts') as $index => $post) {
            BlogPost::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'category' => $post['category'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['excerpt'],
                    'image_path' => $post['image'],
                    'image_alt' => $post['image_alt'],
                    'read_time_minutes' => (int) filter_var($post['read_time'], FILTER_SANITIZE_NUMBER_INT),
                    'status' => BlogPostStatus::Published,
                    'published_at' => now()->subMonths($index + 1),
                    'sort_order' => $index,
                ]
            );
        }
    }

    private function seedTutorials(): void
    {
        foreach (config('site.knowledge_page.tutorials.items') as $index => $item) {
            Tutorial::query()->updateOrCreate(
                ['title' => $item['title']],
                [
                    'icon' => $item['icon'],
                    'level' => $item['level'],
                    'duration' => $item['duration'],
                    'excerpt' => $item['excerpt'],
                    'steps' => $item['steps'],
                    'sort_order' => $index,
                    'is_published' => true,
                ]
            );
        }
    }

    private function seedLegalPages(): void
    {
        foreach (config('site.legal_pages') as $slug => $page) {
            LegalPage::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $page['title'],
                    'content' => $page['content'],
                    'is_published' => true,
                ]
            );
        }
    }

    private function seedFaqs(): void
    {
        foreach (config('site.services_page.faq.items') as $index => $faq) {
            Faq::query()->updateOrCreate(
                ['question' => $faq['question']],
                [
                    'answer' => $faq['answer'],
                    'sort_order' => $index,
                    'is_published' => true,
                ]
            );
        }
    }

    private function seedCalculator(): void
    {
        foreach (config('site.projects_page.calculator.features') as $index => $feature) {
            CalculatorFeature::query()->updateOrCreate(
                ['slug' => $feature['id']],
                [
                    'title' => $feature['title'],
                    'description' => $feature['description'],
                    'price' => $feature['price'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }

        foreach (config('site.projects_page.calculator.scales') as $index => $scale) {
            ProjectScale::query()->updateOrCreate(
                ['slug' => $scale['slug']],
                [
                    'icon' => $scale['icon'],
                    'title' => $scale['title'],
                    'description' => $scale['description'],
                    'multiplier' => $scale['multiplier'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedBookingSlots(): void
    {
        $times = ['09:00:00', '11:30:00', '14:00:00', '16:30:00'];

        foreach (config('admin.bookings.slots') as $index => $label) {
            BookingSlot::query()->updateOrCreate(
                ['time_label' => $label],
                [
                    'time_value' => $times[$index] ?? '09:00:00',
                    'is_active' => true,
                    'sort_order' => $index,
                ]
            );
        }
    }

    private function seedContactMessages(): void
    {
        $statusMap = [
            'غير مقروءة' => ContactMessageStatus::Unread,
            'قيد المتابعة' => ContactMessageStatus::InProgress,
            'تم الرد' => ContactMessageStatus::Replied,
            'مؤرشف' => ContactMessageStatus::Archived,
        ];

        foreach (config('admin.communications.messages') as $message) {
            ContactMessage::query()->updateOrCreate(
                ['email' => $message['email'], 'message' => $message['message']],
                [
                    'name' => $message['name'],
                    'phone' => $message['phone'] ?? null,
                    'project_type' => $message['project_type'],
                    'status' => $statusMap[$message['status']] ?? ContactMessageStatus::Unread,
                ]
            );
        }
    }

    private function seedConsultationBookings(): void
    {
        $statusMap = [
            'مؤكد' => ConsultationBookingStatus::Confirmed,
            'بانتظار التأكيد' => ConsultationBookingStatus::Pending,
        ];

        foreach (config('admin.bookings.items') as $item) {
            $slot = BookingSlot::query()->where('time_label', $item['time'])->first();

            ConsultationBooking::query()->updateOrCreate(
                [
                    'email' => $item['email'],
                    'booking_date' => $this->parseArabicDate($item['date']),
                    'time_label' => $item['time'],
                ],
                [
                    'client_name' => $item['client'],
                    'phone' => $item['phone'] ?? null,
                    'booking_slot_id' => $slot?->id,
                    'status' => $statusMap[$item['status']] ?? ConsultationBookingStatus::Pending,
                    'note' => $item['note'] ?? null,
                ]
            );
        }
    }

    private function seedChangelog(): void
    {
        $typeMap = [
            'feature' => ChangelogEntryType::Feature,
            'improvement' => ChangelogEntryType::Improvement,
            'fix' => ChangelogEntryType::Fix,
            'release' => ChangelogEntryType::Release,
        ];

        foreach (config('admin.changelog.items') as $item) {
            ChangelogEntry::query()->updateOrCreate(
                ['version' => $item['version'], 'title' => $item['title']],
                [
                    'released_at' => $this->parseArabicDate($item['date']),
                    'type' => $typeMap[$item['type']] ?? ChangelogEntryType::Feature,
                    'description' => $item['description'],
                    'author_name' => $item['author'],
                ]
            );
        }
    }

    private function seedAdmin(): void
    {
        Admin::query()->updateOrCreate(
            ['email' => config('admin.credentials.email')],
            [
                'name' => config('admin.user.name'),
                'password' => config('admin.credentials.password'),
                'role' => config('admin.user.role'),
                'avatar_initials' => config('admin.user.avatar_initials'),
                'is_active' => true,
            ]
        );
    }

    private function guessSlug(string $title): ?string
    {
        return match (true) {
            str_contains($title, 'المواقع') || str_contains($title, 'التطبيقات') => 'web-dev',
            str_contains($title, 'ERP') || str_contains($title, 'موارد') => 'erp',
            str_contains($title, 'UI/UX') || str_contains($title, 'واجهات') => 'uiux',
            str_contains($title, 'متاجر') || str_contains($title, 'إلكترون') => 'ecommerce',
            str_contains($title, 'استضافة') || str_contains($title, 'نطاق') => 'hosting',
            str_contains($title, 'تحليل') || str_contains($title, 'هندسة') => 'systems',
            default => null,
        };
    }

    private function extractImagePath(?string $image): ?string
    {
        if ($image === null || str_starts_with($image, 'http')) {
            return $image;
        }

        return $image;
    }

    private function parseArabicDate(string $date): string
    {
        $map = [
            'يناير' => '01', 'فبراير' => '02', 'مارس' => '03', 'أبريل' => '04',
            'مايو' => '05', 'يونيو' => '06', 'يوليو' => '07', 'أغسطس' => '08',
            'سبتمبر' => '09', 'أكتوبر' => '10', 'نوفمبر' => '11', 'ديسمبر' => '12',
        ];

        foreach ($map as $month => $number) {
            if (str_contains($date, $month)) {
                preg_match('/(\d{1,2})\s+/u', $date, $dayMatch);
                preg_match('/(\d{4})/u', $date, $yearMatch);
                $day = str_pad($dayMatch[1] ?? '1', 2, '0', STR_PAD_LEFT);
                $year = $yearMatch[1] ?? now()->year;

                return "{$year}-{$number}-{$day}";
            }
        }

        return now()->toDateString();
    }
}

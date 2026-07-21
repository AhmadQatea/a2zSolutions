<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.2
- laravel/framework (LARAVEL) - v12
- laravel/prompts (PROMPTS) - v0
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- laravel/sail (SAIL) - v1
- pestphp/pest (PEST) - v3
- phpunit/phpunit (PHPUNIT) - v11
- tailwindcss (TAILWINDCSS) - v4

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Always use `search-docs` before making code changes. Do not skip this step. It returns version-specific docs based on installed packages automatically.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== laravel/v12 rules ===

# Laravel 12

- CRITICAL: ALWAYS use `search-docs` tool for version-specific Laravel documentation and updated code examples.
- Since Laravel 11, Laravel has a new streamlined file structure which this project uses.

## Laravel 12 Structure

- In Laravel 12, middleware are no longer registered in `app/Http/Kernel.php`.
- Middleware are configured declaratively in `bootstrap/app.php` using `Application::configure()->withMiddleware()`.
- `bootstrap/app.php` is the file to register middleware, exceptions, and routing files.
- `bootstrap/providers.php` contains application specific service providers.
- The `app/Console/Kernel.php` file no longer exists; use `bootstrap/app.php` or `routes/console.php` for console configuration.
- Console commands in `app/Console/Commands/` are automatically available and do not require manual registration.

## Database

- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 12 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models

- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `php artisan make:test --pest {name}`.
- The `{name}` argument should not include the test suite directory. Use `php artisan make:test --pest SomeFeatureTest` instead of `php artisan make:test --pest Feature/SomeFeatureTest`.
- Run tests: `php artisan test --compact` or filter: `php artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

=== site reference ===

# A2Z Solutions — مرجع الموقع

## الهوية والعلامة التجارية

| العنصر | القيمة |
|--------|--------|
| الاسم | A2Z Solutions |
| الشعار النصي | حلول تقنية متكاملة |
| الألوان | Navy `#0f172a` / `#004362`، Gold `#c9a227` / `#ecc246`، Teal `#0ea5b7` |
| الخطوط | Tajawal + IBM Plex Sans Arabic + Material Symbols Outlined |
| الاتجاه | RTL (`dir="rtl"`) |
| الصور | `logo.png` (رئيسي)، `logo2.png` (أفقي)، `mvpd.png` (خلفية Hero/CTA)، `hero-image.png`، `gold.jpg` |

## مسارات الموقع العام

| المسار | Route | Controller | الوصف |
|--------|-------|------------|-------|
| `/` | `home` | `HomeController` | الصفحة الرئيسية |
| `/services` | `services` | `ServicesController` | الخدمات (bento, FAQ, CTA) |
| `/projects` | `projects` | `ProjectsController` | المشاريع، دراسات الحالة، حاسبة، مستكشف الحلول |
| `/knowledge` | `knowledge` | `KnowledgeController` | مركز المعرفة (عن الشركة، مدونة، تعليمات) |
| `/contact` | `contact` | `ContactController` | التواصل، نموذج، حجز استشارة |

## بيانات التواصل (`config/site.php`)

- **البريد:** `ahmadqatea023@gmail.com`
- **الهاتف/واتساب:** `+963993511250` / `963993511250`
- **الموقع:** سوريا، محافظة إدلب، كرباط
- **الإحداثيات:** `35.93842120265023, 36.64029414273561`

## مفاتيح `config/site.php` الرئيسية

| المفتاح | المحتوى |
|---------|---------|
| `navigation` | روابط الهيدر والفوتر |
| `contact`, `social` | بيانات التواصل ووسائل التواصل |
| `hero` | قسم البطل في الرئيسية |
| `services`, `services_page` | الخدمات (الرئيسية + صفحة كاملة) |
| `why_choose_us`, `projects`, `cta` | أقسام الرئيسية |
| `projects_page` | المشاريع، الفلاتر، `items` (7 مشاريع)، `case_studies` (6 دراسات)، `solutions_finder`، `cost_calculator`، `quote_request` |
| `contact_page` | صفحة التواصل (hero, form, booking, map) |
| `knowledge_page` | مركز المعرفة (`about`, `blog.posts` ×3, `tutorials` ×4) |

## هيكل Views العام

```
resources/views/
├── layouts/main.blade.php
├── pages/{home,services,projects,contact,knowledge}/index.blade.php
└── components/
    ├── layout/     # header, footer, flash-messages
    ├── home/       # hero, services, projects, cta, ...
    ├── services/   # hero, bento-grid, faq, cta
    ├── projects/   # hero, portfolio-grid, case-studies, solutions-finder, cost-calculator, quote-request, cta
    ├── contact/    # hero, form, booking, map, cta
    ├── knowledge/  # hero, about, blog, tutorials, cta
    └── ui/         # button, icon, service-card, project-card, ...
```

## CSS/JS العام

```
public/assets/css/main.css          # نقطة الدخول
public/assets/css/base/             # variables, reset, typography
public/assets/css/layout/           # container, header, footer
public/assets/css/components/       # button, bento-card, faq, ...
public/assets/css/pages/            # home-*, services-page, projects-page, contact-page, knowledge-page
public/assets/js/main.js            # scroll progress, slider, FAQ
public/assets/js/projects-page.js   # فلاتر، pagination دراسات الحالة، مستكشف، حاسبة
public/assets/js/contact-page.js    # تقويم حجز الاستشارة
```

## لوحة التحكم (Admin CMS)

### تسجيل الدخول المحلي

| الحقل | القيمة |
|-------|--------|
| URL | `/admin/login` |
| البريد | `a2zsolutions@admin.com` |
| كلمة المرور | `ahmad123` |

- المصادقة عبر **Session** فقط (`session('admin_authenticated')`) — بدون DB/Model
- Middleware: `admin.auth` → `EnsureAdminAuthenticated`
- الإعدادات في `config/admin.php`

### مسارات اللوحة

| المسار | Route | Controller |
|--------|-------|------------|
| `/admin/login` | `admin.login` | `AuthController@showLoginForm` |
| POST `/admin/login` | `admin.login.submit` | `AuthController@login` |
| POST `/admin/logout` | `admin.logout` | `AuthController@logout` |
| `/admin/dashboard` | `admin.dashboard` | `DashboardController@index` |
| `/admin/communications` | `admin.communications` | `CommunicationController@index` |
| `/admin/bookings` | `admin.bookings` | `BookingController@index` |
| `/admin/services` | `admin.services` | `ServiceController@index` |
| `/admin/projects` | `admin.projects` | `ProjectController@index` |
| `/admin/case-studies` | `admin.case-studies` | `CaseStudyController@index` |
| `/admin/blog` | `admin.blog` | `BlogController@index` |
| `/admin/legal` | `admin.legal` | `LegalController@index` |
| `/admin/changelog` | `admin.changelog` | `ChangelogController@index` |
| `/admin/settings` | `admin.settings` | `SettingsController@index` |

### مسارات الموقع العام

| المسار | Route | Controller |
|--------|-------|------------|
| `/` | `home` | `Web\HomeController@index` |
| `/services` | `services` | `Web\ServicesController@index` |
| `/projects` | `projects` | `Web\ProjectsController@index` |
| `/knowledge` | `knowledge` | `Web\KnowledgeController@index` |
| `/contact` | `contact` | `Web\ContactController@index` |
| POST `/contact` | `contact.store` | `Web\ContactController@store` (throttle:5,1) |
| POST `/contact/booking` | `contact.booking.store` | `Web\ContactController@storeBooking` (throttle:5,1) |
| POST `/projects/quote` | `projects.quote.store` | `Web\QuoteController@store` (throttle:5,1) |
| `/legal/{slug}` | `legal.show` | `Web\LegalController@show` |
| `/sitemap.xml` | `sitemap` | `Web\SitemapController` |

### هيكل Admin

```
routes/admin.php                              # مسارات اللوحة + AuthController
config/admin.php                              # credentials, navigation, dashboard stats
app/Http/Middleware/EnsureAdminAuthenticated.php
app/Http/Controllers/Admin/                   # 11 controllers (كلها تستعلم DB)
app/Http/Controllers/Web/                     # 7 controllers للموقع العام
app/Http/Requests/                            # StoreContactMessageRequest, StoreConsultationBookingRequest
app/Services/Cms/SiteDataService.php          # دمج DB → config('site') مع Cache
app/Support/{MediaPath,SeoMeta}.php           # مسارات الصور + meta SEO
config/seo.php                                # defaults للجمهور السوري (ar_SY)

resources/views/admin/                        # كل صفحة تستقبل بيانات من controller
resources/views/components/ui/lazy-img.blade.php  # lazy loading للصور
resources/views/sitemap/xml.blade.php
resources/views/pages/legal/show.blade.php

public/assets/css/admin/main.css              # نقطة الدخول (بادئة adm-*)
public/assets/js/admin/main.js                # sidebar toggle, فلاتر، بحث
public/assets/js/contact-page.js              # تقويم الحجز + حقول POST
```

### قواعد تنسيق اللوحة

- **بادئة CSS:** `adm-*` (منفصلة عن `a2z-*` للموقع العام)
- **ألوان DevCMS:** خلفية `#0b1326`، primary `#9bccf1`، secondary/gold `#ecc246`
- **البيانات:** تُجلب من قاعدة البيانات عبر Controllers — `SiteDataService` يدمجها في `config('site')` للموقع العام
- **واجهات العرض:** أزرار التعديل/الحفظ جاهزة بصرياً — CRUD كامل لاحقاً

### قاعدة البيانات (CMS Schema)

> **قرار تخزين الصور:** مسار الملف أو رابط URL كامل (`image_path` من نوع `text`) داخل كل جدول يحتاج صورة — **بدون جدول media مركزي**.  
> السبب: أسرع تحميل (صفر joins إضافية)، واستعلام واحد يجلب المحتوى + مسار الصورة.  
> الملفات الفعلية تُخزَّن في `storage/app/public/` أو `public/assets/images/` حسب النوع.  
> Trait مشترك: `App\Models\Concerns\InteractsWithImagePath` → `imageUrl()`.

#### الجداول والعلاقات

| الجدول | Model | قسم اللوحة | ملاحظات |
|--------|-------|------------|---------|
| `admins` | `Admin` | تسجيل الدخول (مستقبلاً) | بديل لـ session/config |
| `services` | `Service` | الخدمات | `slug`, `image_path`, `base_price` للحاسبة |
| `projects` | `Project` | المشاريع | `FK service_id`, `is_featured`, `tags` JSON |
| `case_studies` | `CaseStudy` | دراسات الحالة | `FK project_id?`, `FK service_id`, `focus_type`, `stack`/`results` JSON |
| `contact_messages` | `ContactMessage` | الرسائل | حالات: unread, in_progress, replied, archived |
| `booking_slots` | `BookingSlot` | الحجوزات | أوقات متاحة |
| `consultation_bookings` | `ConsultationBooking` | الحجوزات | `FK booking_slot_id`, `booking_date` |
| `blog_posts` | `BlogPost` | المدونة | `slug`, `status`, `image_path` |
| `tutorials` | `Tutorial` | مركز المعرفة | `steps` JSON |
| `legal_pages` | `LegalPage` | السياسات | privacy, terms, cookies |
| `changelog_entries` | `ChangelogEntry` | سجل التغييرات | version, type, released_at |
| `site_settings` | `SiteSetting` | الإعدادات | key-value بمجموعات: brand, contact, seo, hero |
| `social_links` | `SocialLink` | الإعدادات | روابط التواصل |
| `faqs` | `Faq` | صفحة الخدمات | أسئلة شائعة |
| `calculator_features` | `CalculatorFeature` | حاسبة التكلفة | إضافات المشروع |
| `project_scales` | `ProjectScale` | حاسبة التكلفة | small/medium/large + multiplier |

#### Enums (`app/Enums/`)

- `ContactMessageStatus` — unread, in_progress, replied, archived
- `ConsultationBookingStatus` — pending, confirmed, cancelled, completed
- `CaseStudyFocusType` — problem, goal
- `BlogPostStatus` — draft, published
- `ChangelogEntryType` — feature, improvement, fix, release
- `PublicationStatus` — draft, published (للاستخدام المستقبلي)

#### علاقات Eloquent الرئيسية

```
Service 1──* Project
Service 1──* CaseStudy
Project  1──* CaseStudy (اختياري)
BookingSlot 1──* ConsultationBooking
```

#### Migrations

```
database/migrations/
├── 2026_07_10_233421_create_admins_table.php
├── 2026_07_10_233422_create_services_table.php
├── 2026_07_10_233423_create_projects_table.php
├── 2026_07_10_233424_create_booking_slots_table.php
├── 2026_07_10_233425_create_contact_messages_table.php
├── 2026_07_10_233426_create_consultation_bookings_table.php
├── 2026_07_10_233427_create_blog_posts_table.php
├── 2026_07_10_233428_create_tutorials_table.php
├── 2026_07_10_233429_create_legal_pages_table.php
├── 2026_07_10_233430_create_changelog_entries_table.php
├── 2026_07_10_233431_create_site_settings_table.php
├── 2026_07_10_233432_create_social_links_table.php
├── 2026_07_10_233433_create_faqs_table.php
├── 2026_07_10_233434_create_calculator_features_table.php
├── 2026_07_10_233435_create_project_scales_table.php
└── 2026_07_10_233436_create_case_studies_table.php
```

#### تشغيل الجداول

```bash
php artisan migrate:fresh --seed
```

- Seeder: `database/seeders/CmsSeeder.php` — يملأ كل الجداول من `config/site.php` + `config/admin.php`
- `AppServiceProvider` يستدعي `SiteDataService::hydrateRuntimeConfig()` عند كل طلب HTTP
- Cache: `cms.site.runtime_config` (3600 ثانية) — امسحه بـ `SiteDataService::clearCache()` بعد التعديل

#### Controllers & Validation

**الموقع العام (`app/Http/Controllers/Web/`):**
- كل صفحة تمرّر `$seo` عبر `SeoMeta::forPage()` إلى `layouts.partials.head`
- `ContactController@store` — `StoreContactMessageRequest` + إيميل للمسؤول والعميل
- `ContactController@storeBooking` — `StoreConsultationBookingRequest` + إيميل للمسؤول والعميل
- `QuoteController@store` — `StoreQuoteRequest` + حفظ في `contact_messages` + إيميل
- POST routes محمية بـ `throttle:5,1`

#### البريد الإلكتروني (Gmail SMTP)

- إعدادات `.env`: `MAIL_MAILER=smtp`, `MAIL_HOST=smtp.gmail.com`, `MAIL_PORT=587`, `MAIL_SCHEME=tls`
- `MAIL_USERNAME` / `MAIL_PASSWORD` — حساب Google + App Password
- `MAIL_SCHEME=smtp` لمنفذ 587 (STARTTLS) — **لا تستخدم `tls`** في Laravel 12
- `MAIL_ADMIN_ADDRESS` — مستلمون (مفصولة بفاصلة) لإشعارات الطلبات
- `config/notifications.php` — عناوين الرسائل العربية
- `app/Services/Mail/OutboundMailService.php` — إرسال إشعار للمسؤول + تأكيد للعميل
- قوالب: `resources/views/mail/admin-new-inquiry.blade.php`, `user-inquiry-receipt.blade.php`
- بعد تعديل `.env` شغّل: `php artisan config:clear`
- اختبار الإرسال: `php artisan mail:test`

**اللوحة (`app/Http/Controllers/Admin/`):**
- كل controller يستعلم Models ويمرّر arrays جاهزة للـ Blade
- لا تستخدم `config('admin.*.messages')` في Blade — استخدم متغيرات الـ controller

#### SEO (`config/seo.php` + `layouts/partials/head.blade.php`)

- `title`, `description`, `canonical`, `og:*`, `twitter:*`, `hreflang ar-SY`
- JSON-LD `Organization` schema (إدلب، سوريا)
- Sitemap: `/sitemap.xml`
- الكلمات المفتاحية موجهة للمجتمع السوري العام والتقني

#### Lazy Loading للصور

- مكوّن: `<x-ui.lazy-img :src="..." :alt="..." :eager="false" />`
- Hero فقط: `:eager="true"` + `fetchpriority="high"`
- باقي البطاقات: `loading="lazy"` + `decoding="async"`
- `MediaPath::url()` يحلّ مسارات `image_path` من DB

#### ما لم يُضمَّن (متعمد)

- **جدول media موحّد** — مرفوض لصالح الأداء
- **CRUD كامل في اللوحة** — المرحلة التالية (العرض من DB مكتمل)
- **مستكشف الحلول** — يبقى في config (منطق ثابت + scores)

### استخدام Layout اللوحة

```blade
@extends('admin.layouts.app')

@section('title', 'عنوان الصفحة')
@section('active_nav', 'admin.dashboard')   {{-- route name للتفعيل في sidebar --}}
@section('page_title', 'العنوان')
@section('page_description', 'الوصف')

@section('content')
    {{-- المحتوى --}}
@endsection
```

=== views rules (updated) ===

# Views, Layouts & Components

## Project Structure (Reference)

```
app/
├── Enums/                        # حالات CMS (ContactMessageStatus, ...)
├── Models/ + Concerns/InteractsWithImagePath.php
├── Services/Cms/SiteDataService.php
├── Support/{MediaPath,SeoMeta}.php
└── Http/
    ├── Controllers/Web/          # 7 controllers
    ├── Controllers/Admin/        # 11 controllers
    ├── Requests/                 # StoreContactMessageRequest, StoreConsultationBookingRequest
    └── Middleware/EnsureAdminAuthenticated.php

config/{site,admin,seo}.php
database/seeders/{CmsSeeder,DatabaseSeeder}.php
routes/{web,admin}.php

resources/views/
├── layouts/partials/head.blade.php  # SEO كامل
├── pages/{home,services,projects,contact,knowledge,legal}/
├── sitemap/xml.blade.php
├── admin/                        # بيانات من controllers
└── components/ui/lazy-img.blade.php

public/assets/css/{main,admin}/main.css
public/assets/js/{main,projects-page,contact-page,admin/main}.js
```

## Styling Rules (IMPORTANT)

- **لا تضع تنسيقات Tailwind أو inline styles في Blade** — المكوّنات تستخدم `a2z-*` أو أسماء صفحات واضحة (`services-hero`, `bento-card`, `faq-item`)
- **CSS منظم في `public/assets/css/`** — عدّل الملف المناسب ثم تأكد أن `main.css` يستورده
- Design tokens في `base/variables.css`
- `resources/css/app.css` يبقى لـ Tailwind base فقط
- عند إضافة مكوّن: Blade class + ملف CSS في `components/` أو `pages/`

### Class Naming

| Pattern | Example | Purpose |
|---------|---------|---------|
| Global UI | `a2z-btn`, `a2z-container` | عناصر مشتركة |
| Page block | `services-hero`, `services-bento` | أقسام صفحة محددة |
| BEM element | `bento-card__title` | عنصر داخل المكوّن |
| Modifier | `a2z-btn--gold`, `bento-card--dark` | نسخة/حالة |

## Design System

- Reference design: Nexus Software Systems (`code.html` stitch export)
- Font: **IBM Plex Sans Arabic** + Material Symbols Outlined
- Brand colors (في `:root`): `--a2z-brand-navy`, `--a2z-brand-gold`, `--a2z-brand-teal`
- Direction: RTL (`dir="rtl"`)

## Layout Usage

All public pages extend `layouts.main`. Controllers pass `$seo` array — preferred over `@section('title')`:

```blade
@extends('layouts.main')

@section('full_width')
@endsection

@section('content')
    {{-- page content — data from config('site') hydrated by SiteDataService --}}
@endsection
```

SEO في الـ controller:

```php
return view('pages.home.index', [
    'seo' => SeoMeta::forPage(
        title: config('site.name').' | حلول تقنية سورية',
        description: config('site.hero.description'),
        canonical: route('home'),
    ),
]);
```

Full-width landing pages (no container wrapper):

```blade
@section('full_width')
@endsection

@section('without_flash')
@endsection

@section('content')
    <x-home.hero />
@endsection
```

## Layout Sections & Stacks

| Name | Purpose |
|------|---------|
| `@section('title')` | Page title |
| `@section('meta_description')` | SEO description |
| `@section('content')` | Main page content (required) |
| `@section('main_class')` | Extra classes on `<main>` (default: `a2z-main--offset`) |
| `@section('full_width')` | Remove container wrapper (empty section) |
| `@section('without_header')` | Hide site header (empty section) |
| `@section('without_footer')` | Hide site footer (empty section) |
| `@section('without_flash')` | Hide flash/error messages (empty section) |
| `@push('styles')` / `@stack('styles')` | Page-specific CSS |
| `@push('scripts')` / `@stack('scripts')` | Page-specific JS |

## Component Conventions

| Namespace | Examples | Purpose |
|-----------|----------|---------|
| `x-layout.*` | header, footer, flash-messages | Site shell |
| `x-home.*` | hero, services, projects, cta | Home page sections |
| `x-services.*` | hero, bento-grid, faq, cta | Services page sections |
| `x-ui.*` | button, icon, lazy-img, service-card, project-card, portfolio-card | Reusable UI atoms |
| `x-forms.*` | text-input, textarea, select | Form fields |
| `x-projects.*` | hero, portfolio-grid, case-studies, solutions-finder, cost-calculator, quote-request, cta | Projects page |
| `x-contact.*` | hero, form, booking, map, cta | Contact page |
| `x-knowledge.*` | hero, about, blog, tutorials, cta | Knowledge page |
| `x-admin.*` | sidebar, topbar, stat-card, status-badge | Admin panel shell |
| `x-pagenation` | — | Pagination (existing name) |

- Page content lives in `resources/views/pages/{section}/`
- Section components live in `resources/views/components/{section}/`
- Shared UI atoms live in `resources/views/components/ui/`
- Static text/data: `config/site.php` as fallback — runtime overrides from DB via `SiteDataService`
- Check existing components before creating new ones
- Blade = HTML structure + `a2z-*` classes only; CSS = `public/assets/css/main.css`

## Adding a New Page

1. Add route in `routes/web.php` with named route + controller
2. Create controller method passing `$seo` via `SeoMeta::forPage()`
3. Create `resources/views/pages/{name}/index.blade.php`
4. Extract repeated blocks into `x-{section}.*` or `x-ui.*` components
5. Add DB model/migration/seeder if content is dynamic; else `config/site.php`

## Frontend Assets

- Vite entry: `resources/css/app.css` (Tailwind base), `resources/js/app.js`
- **Design & styles: `public/assets/css/`** ← عدّل الملف المناسب في المجلدات
- Interactions: `public/assets/js/main.js`
- If UI changes do not appear, run `npm run dev` or `composer run dev`

</laravel-boost-guidelines>

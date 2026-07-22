<?php

use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
    $this->withoutMiddleware(ValidateCsrfToken::class);

    foreach ([
        ['brand', 'name', 'A2Z Solutions'],
        ['brand', 'tagline', 'حلول تقنية متكاملة'],
        ['contact', 'email', 'test@example.com'],
        ['contact', 'phone', '+963993511250'],
        ['contact', 'location', 'سوريا'],
        ['contact', 'lat', '35.9'],
        ['contact', 'lng', '36.6'],
        ['seo', 'hero_description', 'وصف تجريبي للصفحة الرئيسية'],
    ] as [$group, $key, $value]) {
        SiteSetting::query()->updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['value' => $value]
        );
    }
});

function settingsPayload(array $social = []): array
{
    return [
        'brand_name' => 'A2Z Solutions',
        'brand_tagline' => 'حلول تقنية متكاملة',
        'contact_email' => 'test@example.com',
        'contact_phone' => '+963993511250',
        'contact_location' => 'سوريا',
        'contact_lat' => '35.9',
        'contact_lng' => '36.6',
        'seo_hero_description' => 'وصف تجريبي للصفحة الرئيسية',
        'seo_services_description' => null,
        'seo_projects_description' => null,
        'social' => $social,
    ];
}

test('admin can update social links when records exist', function () {
    $facebook = SocialLink::query()->create([
        'label' => 'فيسبوك',
        'icon' => 'groups',
        'href' => 'https://www.facebook.com/',
        'sort_order' => 1,
        'is_published' => true,
    ]);
    $instagram = SocialLink::query()->create([
        'label' => 'إنستغرام',
        'icon' => 'camera',
        'href' => 'https://www.instagram.com/',
        'sort_order' => 2,
        'is_published' => true,
    ]);

    $response = $this->withSession(['admin_authenticated' => true])
        ->put(route('admin.settings.update'), settingsPayload([
            [
                'id' => $facebook->id,
                'icon' => 'groups',
                'label' => 'فيسبوك',
                'href' => 'https://www.facebook.com/a2z-solutions',
            ],
            [
                'id' => $instagram->id,
                'icon' => 'camera',
                'label' => 'إنستغرام',
                'href' => 'https://www.instagram.com/a2z',
            ],
        ]));

    $response->assertRedirect(route('admin.settings'));
    $response->assertSessionHas('status');

    expect(SocialLink::query()->whereKey($facebook->id)->value('href'))
        ->toBe('https://www.facebook.com/a2z-solutions');
    expect(SocialLink::query()->whereKey($instagram->id)->value('href'))
        ->toBe('https://www.instagram.com/a2z');
});

test('admin can create social links when form has no ids', function () {
    expect(SocialLink::query()->count())->toBe(0);

    $response = $this->withSession(['admin_authenticated' => true])
        ->put(route('admin.settings.update'), settingsPayload([
            [
                'icon' => 'groups',
                'label' => 'فيسبوك',
                'href' => 'https://www.facebook.com/new-page',
            ],
            [
                'icon' => 'camera',
                'label' => 'إنستغرام',
                'href' => 'https://www.instagram.com/new-page',
            ],
        ]));

    $response->assertRedirect(route('admin.settings'));

    expect(SocialLink::query()->count())->toBe(2);
    expect(SocialLink::query()->where('label', 'فيسبوك')->value('href'))
        ->toBe('https://www.facebook.com/new-page');
});

test('admin can update social links by position when ids are missing', function () {
    $facebook = SocialLink::query()->create([
        'label' => 'فيسبوك',
        'icon' => 'groups',
        'href' => 'https://www.facebook.com/',
        'sort_order' => 1,
        'is_published' => true,
    ]);

    $response = $this->withSession(['admin_authenticated' => true])
        ->put(route('admin.settings.update'), settingsPayload([
            [
                'label' => 'فيسبوك',
                'href' => 'https://www.facebook.com/updated-without-id',
                'icon' => 'groups',
            ],
        ]));

    $response->assertRedirect(route('admin.settings'));

    expect(SocialLink::query()->whereKey($facebook->id)->value('href'))
        ->toBe('https://www.facebook.com/updated-without-id');
});

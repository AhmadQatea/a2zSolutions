<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ClearsCmsCache;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingsRequest;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    use ClearsCmsCache;

    public function index(): View
    {
        $brand = SiteSetting::groupValues('brand');
        $contact = SiteSetting::groupValues('contact');
        $seo = SiteSetting::groupValues('seo');
        $socialLinks = SocialLink::query()->ordered()->get(['id', 'label', 'icon', 'href']);

        if ($socialLinks->isEmpty()) {
            $social = collect(config('site.social'))->map(fn (array $item, int $index): array => [
                'id' => null,
                'label' => $item['label'],
                'icon' => $item['icon'],
                'href' => $item['href'],
            ])->values()->all();
        } else {
            $social = $socialLinks->map(fn (SocialLink $link): array => [
                'id' => $link->id,
                'label' => $link->label,
                'icon' => $link->icon,
                'href' => $link->href,
            ])->all();
        }

        return view('admin.settings.index', [
            'brand' => [
                'name' => $brand['name'] ?? config('site.name'),
                'tagline' => $brand['tagline'] ?? config('site.tagline'),
            ],
            'contact' => [
                'email' => $contact['email'] ?? config('site.contact.email'),
                'phone' => $contact['phone'] ?? config('site.contact.phone'),
                'location' => $contact['location'] ?? config('site.contact.location'),
                'coordinates' => [
                    'lat' => $contact['lat'] ?? config('site.contact.coordinates.lat'),
                    'lng' => $contact['lng'] ?? config('site.contact.coordinates.lng'),
                ],
            ],
            'seo' => [
                'hero_description' => $seo['hero_description'] ?? config('site.hero.description'),
                'services_description' => $seo['services_meta'] ?? config('site.services_page.meta_description'),
                'projects_description' => $seo['projects_meta'] ?? config('site.projects_page.meta_description'),
            ],
            'social' => $social,
        ]);
    }

    public function update(UpdateSettingsRequest $request): RedirectResponse
    {
        $data = $request->validated();

        SiteSetting::setValue('brand', 'name', $data['brand_name']);
        SiteSetting::setValue('brand', 'tagline', $data['brand_tagline']);
        SiteSetting::setValue('contact', 'email', $data['contact_email']);
        SiteSetting::setValue('contact', 'phone', $data['contact_phone']);
        SiteSetting::setValue('contact', 'location', $data['contact_location']);
        SiteSetting::setValue('contact', 'lat', $data['contact_lat']);
        SiteSetting::setValue('contact', 'lng', $data['contact_lng']);
        SiteSetting::setValue('seo', 'hero_description', $data['seo_hero_description']);
        SiteSetting::setValue('seo', 'services_meta', $data['seo_services_description']);
        SiteSetting::setValue('seo', 'projects_meta', $data['seo_projects_description']);

        foreach ($data['social'] ?? [] as $index => $social) {
            if (! empty($social['id'])) {
                SocialLink::query()->whereKey($social['id'])->update([
                    'label' => $social['label'],
                    'href' => $social['href'],
                    'sort_order' => $index + 1,
                ]);
            }
        }

        $this->clearCmsCache(['brand', 'contact', 'seo']);

        return redirect()
            ->route('admin.settings')
            ->with('status', 'تم حفظ الإعدادات بنجاح.');
    }
}

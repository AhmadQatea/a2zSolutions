<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $brand = SiteSetting::groupValues('brand');
        $contact = SiteSetting::groupValues('contact');
        $seo = SiteSetting::groupValues('seo');
        $socialLinks = SocialLink::query()->ordered()->get(['label', 'icon', 'href']);

        if ($socialLinks->isEmpty()) {
            $social = collect(config('site.social'))->all();
        } else {
            $social = $socialLinks->map(fn (SocialLink $link): array => [
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
}

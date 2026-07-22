<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'brand_name' => ['required', 'string', 'max:120'],
            'brand_tagline' => ['required', 'string', 'max:180'],
            'contact_email' => ['required', 'email', 'max:180'],
            'contact_phone' => ['required', 'string', 'max:60'],
            'contact_location' => ['required', 'string', 'max:180'],
            'contact_lat' => ['required', 'string', 'max:40'],
            'contact_lng' => ['required', 'string', 'max:40'],
            'seo_hero_description' => ['required', 'string', 'max:1000'],
            'seo_services_description' => ['nullable', 'string', 'max:1000'],
            'seo_projects_description' => ['nullable', 'string', 'max:1000'],
            'social' => ['nullable', 'array'],
            'social.*.id' => ['nullable', 'integer', 'exists:social_links,id'],
            'social.*.label' => ['required_with:social', 'string', 'max:80'],
            'social.*.href' => ['required_with:social', 'string', 'max:255'],
        ];
    }
}

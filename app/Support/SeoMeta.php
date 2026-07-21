<?php

namespace App\Support;

class SeoMeta
{
    /**
     * @return array<string, mixed>
     */
    public static function forPage(
        string $title,
        string $description,
        string $canonical,
        ?string $image = null,
        string $type = 'website',
    ): array {
        $defaults = config('seo.defaults');
        $organization = config('seo.organization');
        $imageUrl = $image ?? asset($organization['logo']);

        return [
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'image' => $imageUrl,
            'type' => $type,
            'locale' => $defaults['locale'],
            'keywords' => $defaults['keywords'],
            'author' => $defaults['author'],
            'twitter_card' => $defaults['twitter_card'],
            'organization' => $organization,
        ];
    }
}

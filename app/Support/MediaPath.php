<?php

namespace App\Support;

class MediaPath
{
    /**
     * @var array<string, string>
     */
    private const LEGACY_PATHS = [
        'assets/images/hero-image.png' => 'assets/images/hero-image.webp',
        'assets/images/mvpd.png' => 'assets/images/mvpd.webp',
        'assets/images/mvp.png' => 'assets/images/mvpd.webp',
    ];

    public static function url(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $path = self::LEGACY_PATHS[$path] ?? $path;

        return asset($path);
    }
}

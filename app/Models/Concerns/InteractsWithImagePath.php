<?php

namespace App\Models\Concerns;

trait InteractsWithImagePath
{
    public function imageUrl(): ?string
    {
        $path = $this->attributes['image_path'] ?? null;

        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset($path);
    }
}

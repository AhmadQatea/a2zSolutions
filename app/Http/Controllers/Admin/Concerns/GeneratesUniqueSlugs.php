<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait GeneratesUniqueSlugs
{
    /**
     * Build a unique slug for the given model's table, falling back to a random
     * slug when the title cannot produce one (e.g. Arabic-only titles).
     *
     * @param  class-string<Model>  $modelClass
     */
    protected function uniqueSlug(string $modelClass, ?string $slug, string $title, ?int $ignoreId = null): string
    {
        $base = $slug !== null && trim($slug) !== ''
            ? Str::slug($slug)
            : Str::slug($title);

        if ($base === '') {
            $base = 'item-'.Str::lower(Str::random(6));
        }

        $candidate = $base;
        $suffix = 2;

        while (
            $modelClass::query()
                ->where('slug', $candidate)
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->exists()
        ) {
            $candidate = "{$base}-{$suffix}";
            $suffix++;
        }

        return $candidate;
    }
}

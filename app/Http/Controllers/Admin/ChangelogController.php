<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChangelogEntry;
use Illuminate\View\View;

class ChangelogController extends Controller
{
    public function index(): View
    {
        $items = ChangelogEntry::query()->latestFirst()->get();

        if ($items->isEmpty()) {
            $items = collect(config('admin.changelog.items'));
        } else {
            $items = $items->map(fn (ChangelogEntry $entry): array => [
                'version' => $entry->version,
                'type' => $entry->type->value,
                'date' => $entry->released_at?->translatedFormat('d F Y'),
                'title' => $entry->title,
                'description' => $entry->description,
                'author' => $entry->author_name,
            ]);
        }

        return view('admin.changelog.index', [
            'items' => $items,
        ]);
    }
}

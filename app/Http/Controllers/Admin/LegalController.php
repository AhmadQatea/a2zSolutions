<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\View\View;

class LegalController extends Controller
{
    public function index(): View
    {
        $pages = LegalPage::query()->get(['slug', 'title', 'content', 'updated_at']);

        if ($pages->isEmpty()) {
            $pages = collect(config('site.legal_pages'))->map(fn (array $page, string $slug): array => [
                'slug' => $slug,
                'title' => $page['title'],
                'content' => $page['content'],
                'updated_at' => $page['updated_at'] ?? now()->translatedFormat('d F Y'),
            ]);
        } else {
            $pages = $pages->map(fn (LegalPage $page): array => [
                'slug' => $page->slug,
                'title' => $page->title,
                'content' => $page->content,
                'updated_at' => $page->updated_at?->translatedFormat('d F Y'),
            ]);
        }

        return view('admin.legal.index', [
            'pages' => $pages->values()->all(),
        ]);
    }
}

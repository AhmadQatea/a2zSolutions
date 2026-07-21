<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use App\Support\SeoMeta;
use Illuminate\View\View;

class LegalController extends Controller
{
    public function show(string $slug): View
    {
        $page = LegalPage::query()->published()->where('slug', $slug)->firstOrFail();

        return view('pages.legal.show', [
            'page' => $page,
            'seo' => SeoMeta::forPage(
                title: config('site.name').' | '.$page->title,
                description: mb_substr(strip_tags($page->content), 0, 155),
                canonical: route('legal.show', $page->slug),
                type: 'article',
            ),
        ]);
    }
}

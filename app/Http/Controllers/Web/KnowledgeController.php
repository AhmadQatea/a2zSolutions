<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\SeoMeta;
use Illuminate\View\View;

class KnowledgeController extends Controller
{
    public function index(): View
    {
        return view('pages.knowledge.index', [
            'seo' => SeoMeta::forPage(
                title: config('site.name').' | مركز المعرفة',
                description: config('site.knowledge_page.meta_description'),
                canonical: route('knowledge'),
            ),
        ]);
    }
}

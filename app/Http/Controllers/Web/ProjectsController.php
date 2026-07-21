<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\SeoMeta;
use Illuminate\View\View;

class ProjectsController extends Controller
{
    public function index(): View
    {
        return view('pages.projects.index', [
            'seo' => SeoMeta::forPage(
                title: config('site.name').' | المشاريع ودراسات الحالة',
                description: config('site.projects_page.meta_description'),
                canonical: route('projects'),
            ),
        ]);
    }
}

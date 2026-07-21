<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\SeoMeta;
use Illuminate\View\View;

class ServicesController extends Controller
{
    public function index(): View
    {
        return view('pages.services.index', [
            'seo' => SeoMeta::forPage(
                title: config('site.name').' | خدماتنا التقنية',
                description: config('site.services_page.meta_description'),
                canonical: route('services'),
            ),
        ]);
    }
}

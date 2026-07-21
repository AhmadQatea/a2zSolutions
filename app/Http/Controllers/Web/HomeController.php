<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\SeoMeta;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home.index', [
            'seo' => SeoMeta::forPage(
                title: config('site.name').' | حلول تقنية سورية',
                description: config('site.hero.description'),
                canonical: route('home'),
                image: asset(config('site.hero.image')),
            ),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('services'), 'priority' => '0.9'],
            ['loc' => route('projects'), 'priority' => '0.9'],
            ['loc' => route('knowledge'), 'priority' => '0.8'],
            ['loc' => route('contact'), 'priority' => '0.8'],
        ];

        foreach (['privacy', 'terms', 'cookies'] as $slug) {
            $urls[] = ['loc' => route('legal.show', $slug), 'priority' => '0.4'];
        }

        $xml = view('sitemap.xml', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}

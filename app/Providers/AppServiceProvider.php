<?php

namespace App\Providers;

use App\Services\Cms\SiteDataService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SiteDataService::class);
    }

    public function boot(): void
    {
        app(SiteDataService::class)->hydrateRuntimeConfig();

        View::composer('layouts.partials.head', function ($view): void {
            $view->with('defaultSeoImage', asset(config('seo.organization.logo')));
        });
    }
}

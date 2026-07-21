<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::query()->ordered()->get();

        $stats = [
            ['label' => 'إجمالي الخدمات', 'value' => (string) $services->count()],
            ['label' => 'منشورة', 'value' => (string) $services->where('is_published', true)->count()],
            ['label' => 'في الرئيسية', 'value' => (string) $services->where('show_on_home', true)->count()],
            ['label' => 'في صفحة الخدمات', 'value' => (string) $services->where('show_on_services_page', true)->count()],
        ];

        return view('admin.services.index', [
            'stats' => $stats,
            'services' => $services->map(fn (Service $service): array => [
                'icon' => $service->icon,
                'icon_variant' => $service->icon_variant,
                'title' => $service->title,
                'description' => $service->description,
                'is_published' => $service->is_published,
            ]),
        ]);
    }
}

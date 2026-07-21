<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ClearsCmsCache;
use App\Http\Controllers\Admin\Concerns\GeneratesUniqueSlugs;
use App\Http\Controllers\Admin\Concerns\ParsesLineLists;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    use ClearsCmsCache;
    use GeneratesUniqueSlugs;
    use ParsesLineLists;

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
                'id' => $service->id,
                'icon' => $service->icon,
                'icon_variant' => $service->icon_variant,
                'title' => $service->title,
                'description' => $service->description,
                'is_published' => $service->is_published,
            ]),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.create', [
            'service' => new Service(['icon_variant' => 'navy']),
        ]);
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $service = new Service;
        $service->fill($data);
        $service->slug = $this->uniqueSlug(Service::class, $data['slug'] ?? null, $data['title']);
        $service->features = $this->linesToArray($data['features'] ?? null);
        $service->is_published = $request->boolean('is_published');
        $service->show_on_home = $request->boolean('show_on_home');
        $service->show_on_services_page = $request->boolean('show_on_services_page');
        $service->save();

        $this->clearCmsCache();

        return redirect()->route('admin.services')->with('status', 'تم إضافة الخدمة بنجاح.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', [
            'service' => $service,
        ]);
    }

    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();

        $service->fill($data);
        $service->slug = $this->uniqueSlug(Service::class, $data['slug'] ?? null, $data['title'], $service->id);
        $service->features = $this->linesToArray($data['features'] ?? null);
        $service->is_published = $request->boolean('is_published');
        $service->show_on_home = $request->boolean('show_on_home');
        $service->show_on_services_page = $request->boolean('show_on_services_page');
        $service->save();

        $this->clearCmsCache();

        return redirect()->route('admin.services')->with('status', 'تم تحديث الخدمة بنجاح.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        $this->clearCmsCache();

        return redirect()->route('admin.services')->with('status', 'تم حذف الخدمة بنجاح.');
    }
}

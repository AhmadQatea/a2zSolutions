<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ClearsCmsCache;
use App\Http\Controllers\Admin\Concerns\ParsesLineLists;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    use ClearsCmsCache;
    use ParsesLineLists;

    public function index(): View
    {
        $projects = Project::query()
            ->with('service:id,slug,title')
            ->ordered()
            ->get();

        $filterLabels = Service::query()
            ->ordered()
            ->pluck('title', 'slug')
            ->prepend('الكل', 'all')
            ->all();

        if ($filterLabels === ['all' => 'الكل']) {
            $filterLabels = config('admin.projects.filter_labels', []);
        }

        $featuredCount = $projects->where('is_featured', true)->count();
        $featuredLimit = config('admin.projects.featured_limit', 3);

        return view('admin.projects.index', [
            'filterLabels' => $filterLabels,
            'featuredCount' => $featuredCount,
            'featuredLimit' => $featuredLimit,
            'projects' => $projects->map(fn (Project $project): array => [
                'id' => $project->id,
                'service_type' => $project->service?->slug ?? 'all',
                'featured' => $project->is_featured,
                'image' => $project->imageUrl(),
                'image_alt' => $project->image_alt,
                'tags' => $project->tags ?? [],
                'title' => $project->title,
                'description' => $project->description,
            ]),
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.create', [
            'project' => new Project,
            'services' => $this->serviceOptions(),
        ]);
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $project = new Project($data);
        $project->tags = $this->linesToArray($data['tags'] ?? null);
        $project->is_featured = $request->boolean('is_featured');
        $project->is_published = $request->boolean('is_published');
        $project->save();

        $this->clearCmsCache();

        return redirect()->route('admin.projects')->with('status', 'تم إضافة المشروع بنجاح.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', [
            'project' => $project,
            'services' => $this->serviceOptions(),
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();

        $project->fill($data);
        $project->tags = $this->linesToArray($data['tags'] ?? null);
        $project->is_featured = $request->boolean('is_featured');
        $project->is_published = $request->boolean('is_published');
        $project->save();

        $this->clearCmsCache();

        return redirect()->route('admin.projects')->with('status', 'تم تحديث المشروع بنجاح.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        $this->clearCmsCache();

        return redirect()->route('admin.projects')->with('status', 'تم حذف المشروع بنجاح.');
    }

    /**
     * @return array<int, string>
     */
    private function serviceOptions(): array
    {
        return Service::query()->ordered()->pluck('title', 'id')->all();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use Illuminate\View\View;

class ProjectController extends Controller
{
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
}

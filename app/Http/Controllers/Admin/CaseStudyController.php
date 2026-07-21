<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function index(): View
    {
        $cases = CaseStudy::query()
            ->with('service:id,slug,title')
            ->ordered()
            ->get();

        return view('admin.case-studies.index', [
            'focusOptions' => config('admin.case_studies.focus_options'),
            'cases' => $cases->map(fn (CaseStudy $case): array => [
                'service_type' => $case->service?->slug,
                'service_label' => $case->service?->title ?? '—',
                'focus_type' => $case->focus_type->value,
                'client' => $case->client,
                'duration' => $case->duration,
                'stack' => $case->stack ?? [],
                'title' => $case->title,
                'image' => $case->imageUrl(),
                'image_alt' => $case->image_alt,
                'highlight' => [
                    'value' => $case->highlight_value,
                    'label' => $case->highlight_label,
                ],
                'problem' => $case->problem,
                'solution' => $case->solution,
                'goal' => $case->goal,
                'actions_taken' => $case->actions_taken,
                'results' => $case->results ?? [],
            ]),
        ]);
    }
}

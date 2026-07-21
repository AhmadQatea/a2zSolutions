<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ClearsCmsCache;
use App\Http\Controllers\Admin\Concerns\ParsesLineLists;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCaseStudyRequest;
use App\Http\Requests\Admin\UpdateCaseStudyRequest;
use App\Models\CaseStudy;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    use ClearsCmsCache;
    use ParsesLineLists;

    public function index(): View
    {
        $cases = CaseStudy::query()
            ->with('service:id,slug,title')
            ->ordered()
            ->get();

        return view('admin.case-studies.index', [
            'focusOptions' => config('admin.case_studies.focus_options'),
            'cases' => $cases->map(fn (CaseStudy $case): array => [
                'id' => $case->id,
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

    public function create(): View
    {
        return view('admin.case-studies.create', [
            'caseStudy' => new CaseStudy(['focus_type' => 'problem']),
            'services' => $this->serviceOptions(),
            'projects' => $this->projectOptions(),
            'focusOptions' => config('admin.case_studies.focus_options'),
        ]);
    }

    public function store(StoreCaseStudyRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $caseStudy = new CaseStudy($data);
        $caseStudy->stack = $this->linesToArray($data['stack'] ?? null);
        $caseStudy->results = $this->linesToPairs($data['results'] ?? null);
        $caseStudy->is_published = $request->boolean('is_published');
        $caseStudy->save();

        $this->clearCmsCache();

        return redirect()->route('admin.case-studies')->with('status', 'تم إضافة دراسة الحالة بنجاح.');
    }

    public function edit(CaseStudy $case_study): View
    {
        return view('admin.case-studies.edit', [
            'caseStudy' => $case_study,
            'services' => $this->serviceOptions(),
            'projects' => $this->projectOptions(),
            'focusOptions' => config('admin.case_studies.focus_options'),
        ]);
    }

    public function update(UpdateCaseStudyRequest $request, CaseStudy $case_study): RedirectResponse
    {
        $data = $request->validated();

        $case_study->fill($data);
        $case_study->stack = $this->linesToArray($data['stack'] ?? null);
        $case_study->results = $this->linesToPairs($data['results'] ?? null);
        $case_study->is_published = $request->boolean('is_published');
        $case_study->save();

        $this->clearCmsCache();

        return redirect()->route('admin.case-studies')->with('status', 'تم تحديث دراسة الحالة بنجاح.');
    }

    public function destroy(CaseStudy $case_study): RedirectResponse
    {
        $case_study->delete();

        $this->clearCmsCache();

        return redirect()->route('admin.case-studies')->with('status', 'تم حذف دراسة الحالة بنجاح.');
    }

    /**
     * @return array<int, string>
     */
    private function serviceOptions(): array
    {
        return Service::query()->ordered()->pluck('title', 'id')->all();
    }

    /**
     * @return array<int, string>
     */
    private function projectOptions(): array
    {
        return Project::query()->ordered()->pluck('title', 'id')->all();
    }
}

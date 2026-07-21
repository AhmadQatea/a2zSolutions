<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ClearsCmsCache;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateLegalPageRequest;
use App\Models\LegalPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LegalController extends Controller
{
    use ClearsCmsCache;

    public function index(): View
    {
        $pages = LegalPage::query()->get(['id', 'slug', 'title', 'content', 'updated_at']);

        if ($pages->isEmpty()) {
            $pages = collect(config('site.legal_pages'))->map(fn (array $page, string $slug): array => [
                'slug' => $slug,
                'title' => $page['title'],
                'content' => $page['content'],
                'updated_at' => $page['updated_at'] ?? now()->translatedFormat('d F Y'),
            ]);
        } else {
            $pages = $pages->map(fn (LegalPage $page): array => [
                'id' => $page->id,
                'slug' => $page->slug,
                'title' => $page->title,
                'content' => $page->content,
                'updated_at' => $page->updated_at?->translatedFormat('d F Y'),
            ]);
        }

        return view('admin.legal.index', [
            'pages' => $pages->values()->all(),
        ]);
    }

    public function edit(LegalPage $legal_page): View
    {
        return view('admin.legal.edit', [
            'page' => $legal_page,
        ]);
    }

    public function update(UpdateLegalPageRequest $request, LegalPage $legal_page): RedirectResponse
    {
        $data = $request->validated();

        $legal_page->fill($data);
        $legal_page->is_published = $request->boolean('is_published');
        $legal_page->save();

        $this->clearCmsCache();

        return redirect()->route('admin.legal')->with('status', 'تم تحديث الصفحة بنجاح.');
    }
}

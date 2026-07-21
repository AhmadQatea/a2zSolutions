<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ClearsCmsCache;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreChangelogEntryRequest;
use App\Http\Requests\Admin\UpdateChangelogEntryRequest;
use App\Models\ChangelogEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChangelogController extends Controller
{
    use ClearsCmsCache;

    public function index(): View
    {
        $entries = ChangelogEntry::query()->latestFirst()->get();

        $fromDatabase = $entries->isNotEmpty();

        if ($fromDatabase) {
            $items = $entries->map(fn (ChangelogEntry $entry): array => [
                'id' => $entry->id,
                'version' => $entry->version,
                'type' => $entry->type->value,
                'date' => $entry->released_at?->translatedFormat('d F Y'),
                'title' => $entry->title,
                'description' => $entry->description,
                'author' => $entry->author_name,
            ]);
        } else {
            $items = collect(config('admin.changelog.items'));
        }

        return view('admin.changelog.index', [
            'items' => $items,
            'fromDatabase' => $fromDatabase,
        ]);
    }

    public function create(): View
    {
        return view('admin.changelog.create', [
            'entry' => new ChangelogEntry(['type' => 'feature']),
        ]);
    }

    public function store(StoreChangelogEntryRequest $request): RedirectResponse
    {
        $entry = new ChangelogEntry($request->validated());
        $entry->save();

        $this->clearCmsCache();

        return redirect()->route('admin.changelog')->with('status', 'تم إضافة التحديث بنجاح.');
    }

    public function edit(ChangelogEntry $changelog_entry): View
    {
        return view('admin.changelog.edit', [
            'entry' => $changelog_entry,
        ]);
    }

    public function update(UpdateChangelogEntryRequest $request, ChangelogEntry $changelog_entry): RedirectResponse
    {
        $changelog_entry->fill($request->validated());
        $changelog_entry->save();

        $this->clearCmsCache();

        return redirect()->route('admin.changelog')->with('status', 'تم تحديث السجل بنجاح.');
    }

    public function destroy(ChangelogEntry $changelog_entry): RedirectResponse
    {
        $changelog_entry->delete();

        $this->clearCmsCache();

        return redirect()->route('admin.changelog')->with('status', 'تم حذف السجل بنجاح.');
    }
}

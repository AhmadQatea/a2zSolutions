<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BlogPostStatus;
use App\Http\Controllers\Admin\Concerns\ClearsCmsCache;
use App\Http\Controllers\Admin\Concerns\GeneratesUniqueSlugs;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogPostRequest;
use App\Http\Requests\Admin\UpdateBlogPostRequest;
use App\Models\BlogPost;
use App\Models\Tutorial;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    use ClearsCmsCache;
    use GeneratesUniqueSlugs;

    public function index(): View
    {
        $posts = BlogPost::query()->orderByDesc('created_at')->get();
        $tutorials = Tutorial::query()->ordered()->get();

        $stats = [
            ['label' => 'مقالات منشورة', 'value' => (string) $posts->where('status', BlogPostStatus::Published)->count()],
            ['label' => 'مسودات', 'value' => (string) $posts->where('status', BlogPostStatus::Draft)->count()],
            ['label' => 'أدلة تعليمية', 'value' => (string) $tutorials->count()],
            ['label' => 'مشاهدات الشهر', 'value' => (string) config('admin.blog.stats.3.value', '0')],
        ];

        return view('admin.blog.index', [
            'stats' => $stats,
            'posts' => $posts->map(fn (BlogPost $post): array => [
                'id' => $post->id,
                'title' => $post->title,
                'category' => $post->category,
                'date' => $post->published_at?->translatedFormat('d F Y') ?? $post->created_at?->translatedFormat('d F Y'),
                'read_time' => $post->read_time_minutes.' دقائق',
                'excerpt' => $post->excerpt,
                'image' => $post->imageUrl(),
                'image_alt' => $post->image_alt,
                'status' => $post->status->label(),
                'status_variant' => $post->status === BlogPostStatus::Published ? 'success' : 'gold',
            ]),
            'tutorials' => $tutorials->map(fn (Tutorial $tutorial): array => [
                'icon' => $tutorial->icon,
                'title' => $tutorial->title,
                'level' => $tutorial->level,
                'duration' => $tutorial->duration,
                'excerpt' => $tutorial->excerpt,
            ]),
        ]);
    }

    public function create(): View
    {
        return view('admin.blog.create', [
            'post' => new BlogPost(['status' => 'draft', 'read_time_minutes' => 5]),
        ]);
    }

    public function store(StoreBlogPostRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $post = new BlogPost($data);
        $post->slug = $this->uniqueSlug(BlogPost::class, $data['slug'] ?? null, $data['title']);
        $post->save();

        $this->clearCmsCache();

        return redirect()->route('admin.blog')->with('status', 'تم إضافة المقال بنجاح.');
    }

    public function edit(BlogPost $blog_post): View
    {
        return view('admin.blog.edit', [
            'post' => $blog_post,
        ]);
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blog_post): RedirectResponse
    {
        $data = $request->validated();

        $blog_post->fill($data);
        $blog_post->slug = $this->uniqueSlug(BlogPost::class, $data['slug'] ?? null, $data['title'], $blog_post->id);
        $blog_post->save();

        $this->clearCmsCache();

        return redirect()->route('admin.blog')->with('status', 'تم تحديث المقال بنجاح.');
    }

    public function destroy(BlogPost $blog_post): RedirectResponse
    {
        $blog_post->delete();

        $this->clearCmsCache();

        return redirect()->route('admin.blog')->with('status', 'تم حذف المقال بنجاح.');
    }
}

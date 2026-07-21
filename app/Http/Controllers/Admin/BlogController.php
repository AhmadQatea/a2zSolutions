<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BlogPostStatus;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Tutorial;
use Illuminate\View\View;

class BlogController extends Controller
{
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
}

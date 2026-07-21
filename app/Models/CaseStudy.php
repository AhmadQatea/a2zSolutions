<?php

namespace App\Models;

use App\Enums\CaseStudyFocusType;
use App\Models\Concerns\InteractsWithImagePath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseStudy extends Model
{
    use HasFactory;
    use InteractsWithImagePath;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'project_id',
        'service_id',
        'focus_type',
        'client',
        'duration',
        'title',
        'image_path',
        'image_alt',
        'highlight_value',
        'highlight_label',
        'problem',
        'solution',
        'goal',
        'actions_taken',
        'stack',
        'results',
        'sort_order',
        'is_published',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'focus_type' => CaseStudyFocusType::class,
            'stack' => 'array',
            'results' => 'array',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Project, $this>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsTo<Service, $this>
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @param  Builder<CaseStudy>  $query
     * @return Builder<CaseStudy>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * @param  Builder<CaseStudy>  $query
     * @return Builder<CaseStudy>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }
}

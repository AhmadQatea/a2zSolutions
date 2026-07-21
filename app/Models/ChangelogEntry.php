<?php

namespace App\Models;

use App\Enums\ChangelogEntryType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangelogEntry extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'version',
        'released_at',
        'type',
        'title',
        'description',
        'author_name',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'released_at' => 'date',
            'type' => ChangelogEntryType::class,
        ];
    }

    /**
     * @param  Builder<ChangelogEntry>  $query
     * @return Builder<ChangelogEntry>
     */
    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('released_at')->orderByDesc('id');
    }
}

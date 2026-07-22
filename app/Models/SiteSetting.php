<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'group',
        'key',
        'value',
    ];

    /**
     * @return array<string, mixed>
     */
    public static function groupValues(string $group): array
    {
        return Cache::remember(
            "site_settings.{$group}",
            now()->addHour(),
            fn (): array => self::query()
                ->where('group', $group)
                ->pluck('value', 'key')
                ->all()
        );
    }

    public static function getValue(string $group, string $key, ?string $default = null): ?string
    {
        $values = self::groupValues($group);

        return $values[$key] ?? $default;
    }

    public static function forgetGroupCache(string $group): void
    {
        Cache::forget("site_settings.{$group}");
    }

    public static function setValue(string $group, string $key, ?string $value): void
    {
        self::query()->updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['value' => $value]
        );

        self::forgetGroupCache($group);
    }
}

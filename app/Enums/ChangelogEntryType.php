<?php

namespace App\Enums;

enum ChangelogEntryType: string
{
    case Feature = 'feature';
    case Improvement = 'improvement';
    case Fix = 'fix';
    case Release = 'release';

    public function label(): string
    {
        return match ($this) {
            self::Feature => 'ميزة',
            self::Improvement => 'تحسين',
            self::Fix => 'إصلاح',
            self::Release => 'إصدار',
        };
    }
}

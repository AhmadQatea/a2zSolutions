<?php

namespace App\Enums;

enum CaseStudyFocusType: string
{
    case Problem = 'problem';
    case Goal = 'goal';

    public function label(): string
    {
        return match ($this) {
            self::Problem => 'المشكلة + الحل التقني',
            self::Goal => 'الهدف + ما قمنا به',
        };
    }
}

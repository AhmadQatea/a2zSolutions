<?php

namespace App\Enums;

enum ContactMessageStatus: string
{
    case Unread = 'unread';
    case InProgress = 'in_progress';
    case Replied = 'replied';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Unread => 'غير مقروءة',
            self::InProgress => 'قيد المتابعة',
            self::Replied => 'تم الرد',
            self::Archived => 'مؤرشف',
        };
    }
}

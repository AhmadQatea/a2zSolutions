<?php

namespace App\Enums;

enum ConsultationBookingStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Cancelled = 'cancelled';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'بانتظار التأكيد',
            self::Confirmed => 'مؤكد',
            self::Cancelled => 'ملغى',
            self::Completed => 'مكتمل',
        };
    }
}

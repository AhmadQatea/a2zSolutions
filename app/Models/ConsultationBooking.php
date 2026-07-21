<?php

namespace App\Models;

use App\Enums\ConsultationBookingStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationBooking extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'client_name',
        'email',
        'phone',
        'booking_date',
        'booking_slot_id',
        'time_label',
        'status',
        'note',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
            'status' => ConsultationBookingStatus::class,
        ];
    }

    /**
     * @return BelongsTo<BookingSlot, $this>
     */
    public function bookingSlot(): BelongsTo
    {
        return $this->belongsTo(BookingSlot::class);
    }

    /**
     * @param  Builder<ConsultationBooking>  $query
     * @return Builder<ConsultationBooking>
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query
            ->where('booking_date', '>=', now()->toDateString())
            ->whereIn('status', [
                ConsultationBookingStatus::Pending,
                ConsultationBookingStatus::Confirmed,
            ]);
    }

    /**
     * @param  Builder<ConsultationBooking>  $query
     * @return Builder<ConsultationBooking>
     */
    public function scopeOnDate(Builder $query, string $date): Builder
    {
        return $query->whereDate('booking_date', $date);
    }
}

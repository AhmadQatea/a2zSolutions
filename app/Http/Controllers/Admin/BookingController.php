<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ConsultationBookingStatus;
use App\Http\Controllers\Controller;
use App\Models\BookingSlot;
use App\Models\ConsultationBooking;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = ConsultationBooking::query()
            ->with('bookingSlot')
            ->orderByDesc('booking_date')
            ->get();

        $today = now()->toDateString();
        $weekEnd = now()->addDays(7)->toDateString();

        $stats = [
            ['label' => 'حجوزات اليوم', 'value' => (string) $bookings->filter(
                fn (ConsultationBooking $booking): bool => $booking->booking_date->toDateString() === $today
            )->count()],
            ['label' => 'هذا الأسبوع', 'value' => (string) $bookings->filter(
                fn (ConsultationBooking $booking): bool => $booking->booking_date->toDateString() >= $today
                    && $booking->booking_date->toDateString() <= $weekEnd
            )->count()],
            ['label' => 'مؤكدة', 'value' => (string) $bookings->where('status', ConsultationBookingStatus::Confirmed)->count()],
            ['label' => 'بانتظار التأكيد', 'value' => (string) $bookings->where('status', ConsultationBookingStatus::Pending)->count()],
        ];

        $slots = BookingSlot::query()->active()->ordered()->pluck('time_label')->all();

        if ($slots === []) {
            $slots = config('admin.bookings.slots', []);
        }

        return view('admin.bookings.index', [
            'stats' => $stats,
            'slots' => $slots,
            'bookedDays' => $bookings
                ->pluck('booking_date')
                ->map(fn ($date) => $date->format('Y-m-d'))
                ->unique()
                ->values()
                ->all(),
            'items' => $bookings->map(fn (ConsultationBooking $booking): array => [
                'client' => $booking->client_name,
                'email' => $booking->email,
                'phone' => $booking->phone ?? '—',
                'date' => $booking->booking_date->translatedFormat('d F Y'),
                'time' => $booking->time_label,
                'status' => $booking->status->label(),
                'status_variant' => $this->statusVariant($booking->status),
                'note' => $booking->note ?? '—',
            ]),
        ]);
    }

    private function statusVariant(ConsultationBookingStatus $status): string
    {
        return match ($status) {
            ConsultationBookingStatus::Pending => 'gold',
            ConsultationBookingStatus::Confirmed => 'success',
            ConsultationBookingStatus::Cancelled => 'muted',
            ConsultationBookingStatus::Completed => 'primary',
        };
    }
}

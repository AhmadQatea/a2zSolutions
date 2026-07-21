<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ConsultationBookingStatus;
use App\Enums\ContactMessageStatus;
use App\Http\Controllers\Controller;
use App\Models\ConsultationBooking;
use App\Models\ContactMessage;
use App\Models\Project;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()->latestFirst()->limit(4)->get();
        $bookings = ConsultationBooking::query()
            ->upcoming()
            ->orderBy('booking_date')
            ->limit(3)
            ->get();

        $unreadCount = ContactMessage::query()->unread()->count();
        $upcomingCount = ConsultationBooking::query()->upcoming()->count();
        $featuredCount = Project::query()->where('is_featured', true)->count();

        $stats = [
            ['icon' => 'group', 'label' => 'زوار الموقع', 'value' => config('admin.dashboard.stats.0.value', '—'), 'trend' => config('admin.dashboard.stats.0.trend', ''), 'accent' => 'primary'],
            ['icon' => 'inbox', 'label' => 'رسائل جديدة', 'value' => (string) ContactMessage::query()->count(), 'trend' => $unreadCount.' غير مقروءة', 'accent' => 'gold'],
            ['icon' => 'event_available', 'label' => 'حجوزات قادمة', 'value' => (string) $upcomingCount, 'trend' => 'خلال 7 أيام', 'accent' => 'primary'],
            ['icon' => 'star', 'label' => 'مشاريع مميزة', 'value' => (string) $featuredCount, 'trend' => 'في الصفحة الرئيسية', 'accent' => 'gold'],
        ];

        return view('admin.dashboard.index', [
            'stats' => $stats,
            'recentMessages' => $messages->map(fn (ContactMessage $message): array => [
                'name' => $message->name,
                'email' => $message->email,
                'project_type' => $message->project_type,
                'date' => $message->created_at?->translatedFormat('d F Y'),
                'status' => $message->status->label(),
                'status_variant' => $this->messageStatusVariant($message->status),
            ]),
            'upcomingBookings' => $bookings->map(fn (ConsultationBooking $booking): array => [
                'date' => $booking->booking_date->translatedFormat('d F Y'),
                'time' => $booking->time_label,
                'client' => $booking->client_name,
                'status' => $booking->status->label(),
                'status_variant' => $this->bookingStatusVariant($booking->status),
            ]),
        ]);
    }

    private function messageStatusVariant(ContactMessageStatus $status): string
    {
        return match ($status) {
            ContactMessageStatus::Unread => 'gold',
            ContactMessageStatus::InProgress => 'primary',
            ContactMessageStatus::Replied => 'success',
            ContactMessageStatus::Archived => 'muted',
        };
    }

    private function bookingStatusVariant(ConsultationBookingStatus $status): string
    {
        return match ($status) {
            ConsultationBookingStatus::Pending => 'gold',
            ConsultationBookingStatus::Confirmed => 'success',
            ConsultationBookingStatus::Cancelled => 'muted',
            ConsultationBookingStatus::Completed => 'primary',
        };
    }
}

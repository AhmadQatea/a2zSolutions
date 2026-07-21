<?php

namespace App\Services\Mail;

use App\Mail\AdminNewInquiryMail;
use App\Mail\UserInquiryReceiptMail;
use App\Models\ConsultationBooking;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class OutboundMailService
{
    /**
     * @return list<string>
     */
    public function adminRecipients(): array
    {
        $recipients = config('notifications.admin_recipients');

        if ($recipients !== []) {
            return $recipients;
        }

        $fallback = config('notifications.fallback_admin_email');

        return $fallback ? [$fallback] : [];
    }

    public function sendContactNotifications(ContactMessage $message, string $type = 'contact'): bool
    {
        $payload = [
            'name' => $message->name,
            'email' => $message->email,
            'phone' => $message->phone,
            'project_type' => $message->project_type,
            'message' => $message->message,
            'submitted_at' => $message->created_at?->translatedFormat('d F Y — H:i'),
        ];

        $adminSent = $this->notifyAdmin($type, $payload);
        $userSent = $this->notifyUser($message->email, $message->name, $type);

        return $adminSent && $userSent;
    }

    public function sendBookingNotifications(ConsultationBooking $booking): bool
    {
        $payload = [
            'name' => $booking->client_name,
            'email' => $booking->email,
            'phone' => $booking->phone,
            'booking_date' => $booking->booking_date->translatedFormat('d F Y'),
            'time_label' => $booking->time_label,
            'note' => $booking->note,
            'submitted_at' => $booking->created_at?->translatedFormat('d F Y — H:i'),
        ];

        $adminSent = $this->notifyAdmin('booking', $payload);
        $userSent = $this->notifyUser($booking->email, $booking->client_name, 'booking');

        return $adminSent && $userSent;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function notifyAdmin(string $type, array $payload): bool
    {
        $recipients = $this->adminRecipients();

        if ($recipients === []) {
            Log::warning('No admin mail recipients configured.', ['type' => $type]);

            return false;
        }

        try {
            Mail::to($recipients)->send(new AdminNewInquiryMail($type, $payload));

            return true;
        } catch (Throwable $exception) {
            Log::error('Failed to send admin notification email.', [
                'type' => $type,
                'error' => $exception->getMessage(),
            ]);

            return false;
        }
    }

    public function notifyUser(string $email, string $name, string $type): bool
    {
        try {
            Mail::to($email)->send(new UserInquiryReceiptMail($type, $name));

            return true;
        } catch (Throwable $exception) {
            Log::error('Failed to send user receipt email.', [
                'type' => $type,
                'email' => $email,
                'error' => $exception->getMessage(),
            ]);

            return false;
        }
    }
}

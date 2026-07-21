<?php

namespace App\Http\Controllers\Web;

use App\Enums\ConsultationBookingStatus;
use App\Enums\ContactMessageStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationBookingRequest;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\BookingSlot;
use App\Models\ConsultationBooking;
use App\Models\ContactMessage;
use App\Services\Mail\OutboundMailService;
use App\Support\SeoMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $bookedDates = ConsultationBooking::query()
            ->upcoming()
            ->pluck('booking_date')
            ->map(fn ($date) => $date->format('Y-m-d'))
            ->unique()
            ->values()
            ->all();

        return view('pages.contact.index', [
            'seo' => SeoMeta::forPage(
                title: config('site.name').' | تواصل معنا',
                description: config('site.contact_page.meta_description'),
                canonical: route('contact'),
            ),
            'bookingSlots' => BookingSlot::query()->active()->ordered()->get(['id', 'time_label', 'time_value']),
            'bookedDates' => $bookedDates,
        ]);
    }

    public function store(StoreContactMessageRequest $request, OutboundMailService $mail): RedirectResponse
    {
        $message = ContactMessage::query()->create([
            ...$request->validated(),
            'status' => ContactMessageStatus::Unread,
        ]);

        $mailSent = $mail->sendContactNotifications($message, 'contact');

        $response = back()->with('success', 'تم إرسال رسالتك بنجاح. سنتواصل معك خلال 24 ساعة.');

        if (! $mailSent && app()->environment('local')) {
            $response->with('error', 'تم حفظ الرسالة، لكن تعذر إرسال البريد. راجع MAIL_USERNAME وMAIL_PASSWORD في .env');
        }

        return $response;
    }

    public function storeBooking(StoreConsultationBookingRequest $request, OutboundMailService $mail): RedirectResponse
    {
        $booking = ConsultationBooking::query()->create([
            ...$request->validated(),
            'status' => ConsultationBookingStatus::Pending,
        ]);

        $mailSent = $mail->sendBookingNotifications($booking);

        $response = back()->with('success', 'تم تسجيل طلب الحجز. سنؤكد الموعد عبر البريد أو واتساب قريباً.');

        if (! $mailSent && app()->environment('local')) {
            $response->with('error', 'تم حفظ الحجز، لكن تعذر إرسال البريد. راجع MAIL_USERNAME وMAIL_PASSWORD في .env');
        }

        return $response;
    }
}

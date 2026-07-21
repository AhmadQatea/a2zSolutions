<?php

namespace App\Http\Controllers\Web;

use App\Enums\ContactMessageStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuoteRequest;
use App\Models\ContactMessage;
use App\Services\Mail\OutboundMailService;
use Illuminate\Http\RedirectResponse;

class QuoteController extends Controller
{
    public function store(StoreQuoteRequest $request, OutboundMailService $mail): RedirectResponse
    {
        $validated = $request->validated();

        $message = ContactMessage::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'project_type' => 'طلب عرض سعر: '.$validated['subject'],
            'message' => $validated['message'],
            'status' => ContactMessageStatus::Unread,
        ]);

        $mailSent = $mail->sendContactNotifications($message, 'quote');

        $response = redirect()
            ->to(route('projects').'#quote-request')
            ->with('success', 'تم إرسال طلب عرض السعر بنجاح. سنتواصل معك خلال 24 ساعة.');

        if (! $mailSent && app()->environment('local')) {
            $response->with('error', 'تم حفظ الطلب، لكن تعذر إرسال البريد. راجع MAIL_USERNAME وMAIL_PASSWORD في .env');
        }

        return $response;
    }
}

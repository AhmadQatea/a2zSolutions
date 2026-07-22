<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContactMessageStatus;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CommunicationController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()->latestFirst()->get();

        $stats = [
            ['label' => 'إجمالي الرسائل', 'value' => (string) $messages->count()],
            ['label' => 'غير مقروءة', 'value' => (string) $messages->where('status', ContactMessageStatus::Unread)->count()],
            ['label' => 'قيد المتابعة', 'value' => (string) $messages->where('status', ContactMessageStatus::InProgress)->count()],
            ['label' => 'تم الرد', 'value' => (string) $messages->where('status', ContactMessageStatus::Replied)->count()],
        ];

        return view('admin.communications.index', [
            'stats' => $stats,
            'messages' => $messages->map(fn (ContactMessage $message): array => [
                'id' => $message->id,
                'name' => $message->name,
                'email' => $message->email,
                'phone' => $message->phone ?? '—',
                'project_type' => $message->project_type,
                'message' => $message->message,
                'date' => $message->created_at?->translatedFormat('d F Y — H:i'),
                'status' => $message->status->label(),
                'status_value' => $message->status->value,
                'status_variant' => $this->statusVariant($message->status),
            ]),
        ]);
    }

    public function updateStatus(Request $request, ContactMessage $communication): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::enum(ContactMessageStatus::class)],
        ]);

        $status = ContactMessageStatus::from($validated['status']);

        $communication->update([
            'status' => $status,
            'read_at' => $status === ContactMessageStatus::Unread ? null : ($communication->read_at ?? now()),
            'replied_at' => $status === ContactMessageStatus::Replied ? now() : $communication->replied_at,
        ]);

        return redirect()
            ->route('admin.communications')
            ->with('status', 'تم تحديث حالة الرسالة.');
    }

    private function statusVariant(ContactMessageStatus $status): string
    {
        return match ($status) {
            ContactMessageStatus::Unread => 'gold',
            ContactMessageStatus::InProgress => 'primary',
            ContactMessageStatus::Replied => 'success',
            ContactMessageStatus::Archived => 'muted',
        };
    }
}

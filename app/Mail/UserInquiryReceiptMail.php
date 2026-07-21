<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserInquiryReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $type,
        public string $name,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config("notifications.receipt_subjects.{$this->type}", 'تم استلام طلبك — A2Z Solutions'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.user-inquiry-receipt',
            with: [
                'type' => $this->type,
                'name' => $this->name,
            ],
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

<?php

namespace App\Console\Commands;

use App\Mail\AdminNewInquiryMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MailTestCommand extends Command
{
    protected $signature = 'mail:test {recipient? : Optional recipient email}';

    protected $description = 'Send a test inquiry email using current MAIL_* settings';

    public function handle(): int
    {
        $recipient = $this->argument('recipient')
            ?? config('notifications.admin_recipients')[0]
            ?? config('mail.from.address');

        $this->line('Mailer: '.config('mail.default'));
        $this->line('Host: '.config('mail.mailers.smtp.host'));
        $this->line('Username: '.config('mail.mailers.smtp.username'));
        $this->line('From: '.config('mail.from.address'));
        $this->line('Sending test to: '.$recipient);

        try {
            Mail::to($recipient)->send(new AdminNewInquiryMail('contact', [
                'name' => 'اختبار النظام',
                'email' => 'test@example.com',
                'phone' => '+963900000000',
                'project_type' => 'اختبار SMTP',
                'message' => 'هذه رسالة اختبار من A2Z Solutions.',
                'submitted_at' => now()->translatedFormat('d F Y — H:i'),
            ]));

            $this->info('Test email sent successfully.');

            return self::SUCCESS;
        } catch (Throwable $exception) {
            $this->error('Mail failed: '.$exception->getMessage());

            return self::FAILURE;
        }
    }
}

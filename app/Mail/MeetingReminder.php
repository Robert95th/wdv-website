<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\EstateMatter;

class MeetingReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;

    public function __construct(EstateMatter $meeting)
    {
        $this->meeting = $meeting;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reminder: Meeting for ' . $this->meeting->reference . ' Tomorrow',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.meeting-reminder',
        );
    }
}
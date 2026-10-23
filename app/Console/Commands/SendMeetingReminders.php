<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EstateMatter;
use App\Models\MailingList;
use App\Mail\MeetingReminder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\MeetingReminderMail;
class SendMeetingReminders extends Command
{
   protected $signature = 'reminders:meetings';
    protected $description = 'Sends email reminders for meetings happening tomorrow';

    public function handle()
    {
        $this->info('Checking for meetings scheduled for tomorrow...');

        // 1. Find active meetings where the expiry_date is tomorrow
        $tomorrow = Carbon::tomorrow();
        
        $meetings = EstateMatter::where('view_status', true)
            ->whereDate('expiry_date', $tomorrow)
            ->get();

        if ($meetings->isEmpty()) {
            $this->info('No meetings scheduled for tomorrow.');
            return;
        }

        // 2. Fetch the active recipients from the Mailing List
        $recipients = MailingList::where('is_active', true)->get();

        if ($recipients->isEmpty()) {
            $this->error('No active recipients found in the mailing list. Please add them in the Admin Dashboard.');
            return;
        }

        // 3. Loop through meetings and send emails to all active recipients
        foreach ($meetings as $meeting) {
            foreach ($recipients as $recipient) {
                Mail::to($recipient->email)->send(new MeetingReminder($meeting));
            }
            
            $this->line("Sent reminder for: {$meeting->reference} to " . $recipients->count() . " recipient(s).");
        }

        $this->info("Successfully sent {$meetings->count()} meeting reminder(s).");
    }
}
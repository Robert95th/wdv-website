<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EstateMatter;
use App\Mail\MeetingReminder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendMeetingReminders extends Command
{
    protected $signature = 'reminders:meetings';
    protected $description = 'Sends email reminders for meetings happening tomorrow';

    public function handle()
    {
        $this->info('Checking for meetings scheduled for tomorrow...');

        // Find active meetings where the expiry_date is tomorrow
        $tomorrow = Carbon::tomorrow();
        
        $meetings = EstateMatter::where('view_status', true)
            ->whereDate('expiry_date', $tomorrow)
            ->get();

        if ($meetings->isEmpty()) {
            $this->info('No meetings scheduled for tomorrow.');
            return;
        }

        // Send email to the admin (You can change this to a specific address)
        // Alternatively, you can loop through a list of staff emails.
        $adminEmail = 'wiam@iande.co'; 

        foreach ($meetings as $meeting) {
            Mail::to($adminEmail)->send(new MeetingReminder($meeting));
            $this->line("Sent reminder for: {$meeting->reference}");
        }

        $this->info("Successfully sent {$meetings->count()} meeting reminder(s).");
    }
}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\MailingList;
use App\Mail\RequestSummary;

class SendDailyRequestSummary extends Command
{
    protected $signature = 'reminders:requests';
    protected $description = 'Sends daily request summaries';

    public function handle()
    {
        $this->info('Generating request summaries...');

        // 1. Fetch your request data (Update this query to match your actual model/logic)
        $requests = ServiceRequest::whereDate('created_at', today())->get();

        // 2. Fetch active recipients
        $recipients = MailingList::where('is_active', true)->get();

        if ($recipients->isEmpty()) {
            $this->error('No active recipients found in the mailing list.');
            return;
        }

        // 3. Send the email
        foreach ($recipients as $recipient) {
            // Assuming you have a RequestSummary Mailable
            Mail::to($recipient->email)->send(new RequestSummary($requests));

            $this->line("Sent request summary to: {$recipient->email}");
        }

        $this->info("Successfully sent request summaries to " . $recipients->count() . " recipient(s).");
    }
}

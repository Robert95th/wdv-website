<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDailyRequestSummary extends Command
{
    protected $signature = 'reminders:requests';
    protected $description = 'Sends a daily summary of service requests received';

    public function handle()
    {
        $this->info('Checking for new service requests...');

        // Get requests submitted yesterday
        $yesterday = Carbon::yesterday();
        $requests = ServiceRequest::whereDate('created_at', $yesterday)->get();

        if ($requests->isEmpty()) {
            $this->info('No new service requests received.');
            return;
        }

        // We will build a simple text-based email for this summary to save time
        $emailBody = "Good morning,\n\nHere is a summary of the service requests received yesterday:\n\n";

        foreach ($requests as $req) {
            $emailBody .= "- Service: {$req->service}\n";
            $emailBody .= "  Name: {$req->name}\n";
            $emailBody .= "  Email: {$req->email}\n";
            $emailBody .= "  Phone: {$req->phone}\n";
            $emailBody .= "  Date requested: {$req->created_at->format('H:i')}\n\n";
        }

        $emailBody .= "Please log in to the admin dashboard to view full details.";

        // Send the email
        $adminEmail = 'wiam@iande.co';
        
        Mail::raw($emailBody, function ($message) use ($adminEmail) {
            $message->to($adminEmail)
                    ->subject('Daily Service Request Summary');
        });

        $this->info("Successfully sent summary for {$requests->count()} request(s).");
    }
}
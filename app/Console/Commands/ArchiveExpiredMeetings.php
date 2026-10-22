<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EstateMatter;
use Carbon\Carbon;

class ArchiveExpiredMeetings extends Command
{
    // The command you will type in the terminal
    protected $signature = 'meetings:archive';

    // The description shown in artisan list
    protected $description = 'Automatically archives meetings that have passed their expiry date';

    public function handle()
    {
        $this->info('Checking for expired meetings...');

        // Find meetings that are currently visible (view_status = true)
        // AND have an expiry_date that is strictly before today.
        $expiredMeetings = EstateMatter::where('view_status', true)
            ->whereNotNull('expiry_date')
            ->whereDate('expiry_date', '<', Carbon::today())
            ->get();

        if ($expiredMeetings->isEmpty()) {
            $this->info('No expired meetings found. Nothing to archive.');
            return;
        }

        $count = $expiredMeetings->count();

        foreach ($expiredMeetings as $meeting) {
            $meeting->update(['view_status' => false]);
            
            // Optional: Output to terminal for logging
            $this->line("Archived: {$meeting->reference} - {$meeting->estate_matter}");
        }

        $this->info("Successfully archived {$count} expired meeting(s).");
    }
}
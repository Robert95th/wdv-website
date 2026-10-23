<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('meetings:archive')->daily();

// Run the meeting reminder at 7:00 AM every day
Schedule::command('reminders:meetings')->dailyAt('10:58');

// Run the request summary at 7:30 AM every day
Schedule::command('reminders:requests')->dailyAt('10:56');
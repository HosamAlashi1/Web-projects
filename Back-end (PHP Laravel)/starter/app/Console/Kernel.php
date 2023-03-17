<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('command:name')->everyMinute(); // command:name >> this name for task scedluer 
        // can change from Expiration.php 
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected  $commands = [
        \App\Console\Commands\expiration::class,
    ];
}

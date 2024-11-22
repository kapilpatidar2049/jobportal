<?php

namespace App\Console;

use App\Console\Commands\ExportTranslations;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Torann\Currency\Console\Update::class,
        \Torann\Currency\Console\Cleanup::class,
        \Torann\Currency\Console\Manage::class,
        ExportTranslations::class,
        // Add other commands as needed
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Define scheduled commands here
        // Example: $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Load commands from the `routes/console.php` file
        $this->load(__DIR__.'/Commands');

        // Load any additional commands from a specific location
        // $this->load(__DIR__.'/AnotherCommandDirectory');

        // Load routes for console commands
        require base_path('routes/console.php');
    }
}

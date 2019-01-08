<?php

namespace App\Console;

use App\Console\Schedules\DailyTasks;
use App\Console\Schedules\WeeklyTasks;
use App\Console\Schedules\HourlyTasks;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      //$schedule->call(new DailyTasks)->hourly();
      $schedule->job(new DailyTasks)->everyMinute();
      /*
       * $schedule->call(new HourlyTasks)->hourly();
     
      $schedule->call(new WeeklyTasks)->weekly();*/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

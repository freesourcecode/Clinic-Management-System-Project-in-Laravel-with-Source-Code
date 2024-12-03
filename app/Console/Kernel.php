<?php

namespace App\Console;

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
        $schedule->call(function () {
            
            $db_name = env('DB_DATABASE', 'hms');
            $db_user = env('DB_USERNAME', 'root');
            $db_password = env('DB_PASSWORD', 'root');
            $db_host = env('DB_HOST', '127.0.0.1z');
            $backup_path = public_path( 'daily_backup'.date('Y-M-d').'.sql');

            //DO NOT EDIT BELOW THIS LINE
            //Export the database and output the status to the page
            $command = 'mysqldump --opt -h' .$db_host .' -u' .$db_user .' -p' .$db_password .' ' .$db_name .' > ' .$backup_path;
            //return $command;
            $output = array();
            exec($command, $output , $worked);

        })->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

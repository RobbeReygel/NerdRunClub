<?php

namespace App\Console\Commands;

use App\Notifications\Motivation;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use Log;
use App\User;

class UpdateUserNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send out notifications to inactive users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $users = User::has('activities')->get();

        foreach($users as $user) {

            $fdate = $user->lastActivity->first()->created_at;
            $tdate = Carbon::now();

            $datetime1 = new DateTime($fdate);
            $datetime2 = new DateTime($tdate);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');

            if ($days > 7) {
                $user->notify(new Motivation());
                Log::info('More than 7 days!' . $user->first_name);
            }else {
                Log::info('Less than 7 days!' . $user->first_name);
            }

        }


    }
}

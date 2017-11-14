<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Api\Strava;

class UpdateUserActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activities:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates all user activities to database';

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

        foreach (User::all() as $user) {
            $strava = new Strava();
            $strava->updateUserActivities($user);
        }
    }
}

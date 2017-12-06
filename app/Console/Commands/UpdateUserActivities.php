<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Api\Strava;
use Illuminate\Support\Facades\Log;

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
            $job = (new \App\Jobs\UpdateUserActivities($user));
            dispatch($job);
            Log::info('dispatching job for' . $user);
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Medal;
use App\Notifications\MedalReceived;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class GiveMedals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'medals:give';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give medals to everyone who deserves it';

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
            $previousWeek = $user->getRanPreviousWeek();
            $thisWeek = $user->getRanThisWeek();

            $totalRanPreviousWeek = 0;
            foreach ($previousWeek as $a) {
                $totalRanPreviousWeek += $a->distance;
            }

            $totalRanThisWeek = 0;
            foreach ($thisWeek as $a) {
                $totalRanThisWeek += $a->distance;
            }

            $goalThisWeek = round(($totalRanPreviousWeek * 1.1) / 1000);
            if ($goalThisWeek < 3)
                $goalThisWeek = 3;

            $perc = round(($totalRanThisWeek / 1000) / $goalThisWeek * 100);

            if ($perc >= 25 && $perc < 50) {
                $medal = new Medal();
                $medal->type = "bronze";
                $medal->short_name = "WEEKLY";
                $medal->long_name = "Weekly reward 25%";
                $medal->user_id = $user->id;
                $medal->save();
                $user->notify(new MedalReceived());
            } else if ($perc >= 50 && $perc < 100) {
                $medal = new Medal();
                $medal->type = "silver";
                $medal->short_name = "WEEKLY";
                $medal->long_name = "Weekly reward 50%";
                $medal->user_id = $user->id;
                $medal->save();
                $user->notify(new MedalReceived());
            } else if ($perc >= 100 && $perc < 200) {
                $medal = new Medal();
                $medal->type = "gold";
                $medal->short_name = "WEEKLY";
                $medal->long_name = "Weekly reward 100%";
                $medal->user_id = $user->id;
                $medal->save();
                $user->notify(new MedalReceived());
            } else if ($perc >= 200) {
                $medal = new Medal();
                $medal->type = "platinum";
                $medal->short_name = "WEEKLY";
                $medal->long_name = "Weekly reward 200%";
                $medal->user_id = $user->id;
                $medal->save();
                $user->notify(new MedalReceived());
            }
        }
    }
}

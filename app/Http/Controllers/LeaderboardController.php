<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Api\Strava;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\User;

class LeaderboardController extends Controller
{
    public function cmp($a, $b)
    {
        return strcmp($a->totalDistance, $b->totalDistance);
    }

    public function index(Strava $strava)
    {



        $users = User::has('activities')->get();
        $list = array();
        $i = 1;

        foreach ($users as $u) {

            $fdate = $u->lastActivity->first()->created_at;
            $tdate = Carbon::now();

            $datetime1 = new DateTime($fdate);
            $datetime2 = new DateTime($tdate);
            $interval = $datetime1->diff($datetime2);
            $dayslist = $interval->format('%a');

            if($dayslist < 7) {
                $res = $u;
                $res->totalDistanceWeekly = $u->totalDistanceWeekly[0]->sum_distance;
                $list[] = $res;
            }else{
                $res = $u;
                $res->totalDistanceWeekly = 0;
                $list[] = $res;
            }


        }

        usort($list , function( $a, $b) {
            if( $a->totalDistanceWeekly == $b->totalDistanceWeekly)
                return 0;
            return $a->totalDistanceWeekly < $b->totalDistanceWeekly ? 1 : -1; // Might need to switch 1 and -1
        });

        $list = array_slice($list, 0, 50);

        return view('leaderboard', compact('list','i'));
    }
}

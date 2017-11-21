<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Api\Strava;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Auth;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $strava = new Strava();
        $strava->updateUserActivities($user);

        $goal = $this->getWeeklyGoal();

        /*
        $users = User::has('activities')->get();
        $list = array();


        foreach ($users as $u) {
            $fdate = $u->lastActivity->first()->created_at;
            $tdate = Carbon::now();

            $datetime1 = new DateTime($fdate);
            $datetime2 = new DateTime($tdate);
            $interval = $datetime1->diff($datetime2);
            $dayslist = $interval->format('%a');
            if($dayslist < 7) {
                $res = $u;
                if (array_key_exists(0, $u->totalDistanceWeekly)) {
                    $res->totalDistanceWeekly = $u->totalDistanceWeekly[0]->sum_distance;
                } else {
                    $res->totalDistanceWeekly = 0;
                }

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

        */

        return view('dashboard', compact('user', 'goal'));
    }

    public function getWeeklyGoal() {
        $user = Auth::user();
        $data = [];

        $previouwWeek = $user->getRanPreviousWeek();
        $thisWeek = $user->getRanThisWeek();

        $totalRanPreviousWeek = 0;
        $totalTimePreviousWeek = 0;
        foreach ($previouwWeek as $a) {
            $totalRanPreviousWeek += $a->distance;
            $totalTimePreviousWeek += $a->moving_time;
        }

        $totalRanThisWeek = 0;
        $totalTimeThisWeek = 0;
        foreach ($thisWeek as $a) {
            $totalRanThisWeek += $a->distance;
            $totalTimeThisWeek += $a->moving_time;
        }

        $goalThisWeek = round(($totalRanPreviousWeek * 1.1) / 1000);
        if ($goalThisWeek < 3)
            $goalThisWeek = 3;

        $goalNextWeek = round($goalThisWeek + ($totalRanThisWeek * .3) / 1000);

        $data["totalRanThisWeek"] = $totalRanThisWeek;
        $data["totalRanPreviousWeek"] = $totalRanPreviousWeek;
        $data["totalTimeThisWeek"] = $totalTimeThisWeek;
        $data["totalTimePreviousWeek"] = $totalTimePreviousWeek;
        $data["goalThisWeek"] = $goalThisWeek;
        $data["goalNextWeek"] = $goalNextWeek;

        return $data;
    }
}

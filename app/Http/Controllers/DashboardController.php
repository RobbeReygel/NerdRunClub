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

        $goal = $this->getWeeklyGoal();

        $strava = new Strava();
        $strava->updateUserActivities($user);

        $fdate = $user->lastActivity->first()->created_at;
        $tdate = Carbon::now();

        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');


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

        $list = array_slice($list, 0, 3);

        return view('dashboard', compact('user', 'list', 'days', 'goal'));
    }

    public function getWeeklyGoal() {
        $user = Auth::user();
        $data = [];

        $previouwWeek = $user->getRanPreviousWeek();
        $thisWeek = $user->getRanThisWeek();

        $totalRanPreviousWeek = 0;
        foreach ($previouwWeek as $a) {
            $totalRanPreviousWeek += $a->distance;
        }

        $totalRanThisWeek = 0;
        foreach ($thisWeek as $a) {
            $totalRanThisWeek += $a->distance;
        }

        $goalThisWeek = round(($totalRanPreviousWeek * 1.1) / 1000);
        if ($goalThisWeek < 3)
            $goalThisWeek = 3;

        $goalNextWeek = round($goalThisWeek + ($totalRanThisWeek * .3) / 1000);

        $data["totalRanThisWeek"] = $totalRanThisWeek;
        $data["goalThisWeek"] = $goalThisWeek;
        $data["goalNextWeek"] = $goalNextWeek;

        return $data;
    }
}

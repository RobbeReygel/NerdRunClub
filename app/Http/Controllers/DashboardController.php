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

        $user->giveMedal();

        $goal = $this->getWeeklyGoal();

        $weeks = array(50, 51, 52, 1, 2, 3, 4, 5, 6);

        $medals = $user->goldMedals;

        $test = array();

        foreach($medals as $medal)
        {
            array_push($test, $medal->week);
        }


        return view('dashboard', compact('user', 'goal', 'weeks', 'test'));
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

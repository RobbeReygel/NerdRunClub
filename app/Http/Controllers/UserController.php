<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::all()
        ->search($keyword);
        return view('users/users', compact('users', 'keyword'));
    }

    public function show($id)
    {
        $clickedUser = User::find($id);
        $goal = $this->getWeeklyGoal($id);
        $activities = $clickedUser->activities;
        return view('users/user', compact('clickedUser', 'goal', 'activities'));
    }

    public function getWeeklyGoal($id) {
        $user = User::find($id);
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

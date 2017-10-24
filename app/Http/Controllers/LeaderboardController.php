<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\Strava;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\User;

class LeaderboardController extends Controller
{
    public function index(Strava $strava)
    {

        //$list = User::with('sumDistance')->get();

        $list = User::with('sumDistance')->get()->sortBy("sumDistance.sum_distance");
        return view('leaderboard', compact('list'));

/*
        $users = User::all();
        $list = array();

        foreach ($users as $user) {

            $res = $user->sumDistance;

            $list[] = $res;
        }

        dd($list);
*/


    }
}

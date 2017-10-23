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

        $res= User::with('sumDistance')->all();

        dd($res);

        //return view('leaderboard', compact('apiResults'));

    }
}

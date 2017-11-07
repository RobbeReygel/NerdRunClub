<?php

namespace App\Http\Controllers;

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

        foreach ($users as $user) {
            $res = $user;
            $res->totalDistance = $user->totalDistance[0]->sum_distance;
            $list[] = $res;
        }

        usort($list , function( $a, $b) {
            if( $a->totalDistance == $b->totalDistance)
                return 0;
            return $a->totalDistance < $b->totalDistance ? 1 : -1; // Might need to switch 1 and -1
        });

        $list = array_slice($list, 0, 50);

        return view('leaderboard', compact('list'));
    }
}

<?php

namespace App\Http\Controllers;

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

        $users = User::has('activities')->get();
        $list = array();


        foreach ($users as $u) {
            $res = $u;
            $res->totalDistanceWeekly = $u->totalDistanceWeekly[0]->sum_distance;
            $list[] = $res;
        }


        usort($list , function( $a, $b) {
            if( $a->totalDistanceWeekly == $b->totalDistanceWeekly)
                return 0;
            return $a->totalDistanceWeekly < $b->totalDistanceWeekly ? 1 : -1; // Might need to switch 1 and -1
        });

        $list = array_slice($list, 0, 3);

        return view('dashboard', compact('user', 'list'));
    }
}

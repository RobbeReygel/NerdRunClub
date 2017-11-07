<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Api\Strava;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ActivitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Strava $strava)
    {
        $activities = Auth::user()->activities;
        return view('activities', compact('activities'));
  
    }

}

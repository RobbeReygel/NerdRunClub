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
        $activities = $strava::get('athlete/activities', ['query' => 'access_token=' . Auth::user()->token]);
        foreach ($activities as $activity) {
            Activity::updateOrCreate(
                ['activityId' => $activity->id],
                ['name' => $activity->name, 'distance' => $activity->distance, 'user_id' => Auth::user()->id, 'moving_time' => $activity->moving_time, 'start_date' => $activity->start_date]
            );

            //TODO remove activities from database when removed in Strava
            //Activity::where('activityId', "!=" , $apiResult->id)->delete();

        }

        $apiResults = Auth::user()->activities;
        return view('activities', compact('apiResults'));
  
    }

}

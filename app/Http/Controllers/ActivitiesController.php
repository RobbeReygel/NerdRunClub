<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use GuzzleHttp\Client;
use App\Strava;
use App\User;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();

        $mem = User::where('id',$user) -> first();
        $token = $mem->token;

        $strava = new Strava($mem->token);

        //updates activities to database when page loads (scheduled every hour for all users)
        $strava->updateUserActivities();

        $client = new \GuzzleHttp\Client();

        $res = $client->request('GET', 'https://www.strava.com/api/v3/athlete/activities',
            ['query' => http_build_query([
                "access_token" => $token
            ])]);



        $apiResults = json_decode($res->getBody(), false);
/*
        foreach ($apiResults as $apiResult)
        {

            echo $apiResult->name;
            echo $apiResult->id;
            echo "</br>";

        }
*/
        return view('activities', compact('apiResults'));
  
    }

}

<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Api\Strava;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MedalController extends Controller
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
     * Show the application medals.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medals');
    }

}

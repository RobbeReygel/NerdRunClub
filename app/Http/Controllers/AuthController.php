<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Api\Strava;

class AuthController extends Controller
{
    public function redirect(Strava $strava) {
        return redirect($strava::redirectToStrava());
    }

    public function callback(Strava $strava) {
        $login = $strava::finalizeLogin(request()->get('code'));

        $user_from_strava = $strava::get('athlete', ['query' => 'access_token=' . $login->access_token]);

        $user = User::firstOrNew(['strava_id' => $user_from_strava->id]);

        $user->first_name = $user_from_strava->firstname;
        $user->last_name = $user_from_strava->lastname;
        $user->sex = $user_from_strava->sex;
        $user->avatar = $user_from_strava->profile;
        $user->email = $user_from_strava->email;
        $user->token = $login->access_token;
        $user->save();

        //$user->giveMedal();

        Auth::login($user);

        $strava = new Strava();
        $strava->updateUserActivities($user);
        
        return redirect()->route('dashboard');
    }
    
    public function test() {
        $user = Auth::user();
        $memes = $user;

    }

    public function logout() {
        Session::flush();
        return redirect()->route('index');
    }
}

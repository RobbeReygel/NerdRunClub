<?php

namespace App\Http\Controllers;

use App\Strava;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function redirect() {
        return redirect(Strava::redirectToStrava());
    }

    public function callback() {
        $login = Strava::finalizeLogin(request()->get('code'));

        $strava = new Strava($login->access_token);

        $user_from_strava = $strava->getLoggedInUser();

        $user = User::firstOrNew(['strava_id' => $user_from_strava->id]);

        $user->first_name = $user_from_strava->firstname;
        $user->last_name = $user_from_strava->lastname;
        $user->sex = $user_from_strava->sex;
        $user->avatar = $user_from_strava->profile;
        $user->email = $user_from_strava->email;
        $user->token = $login->access_token;

        $user->save();

        Auth::login($user);
        
        return redirect('/test');
    }
    
    public function test() {
        $user = Auth::user();
        $memes = $user;

    }
}

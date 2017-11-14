<?php

namespace App\Api;

use GuzzleHttp\Client;
use App\User;
use App\Activity;

class Strava
{
    static $client_secret;
    static $client_id;
    static $client;

    public function __construct()
    {
        self::$client_secret = "a330975d3dfb689a84cb382d18d1dbc0e85392c3";
        self::$client_id = "20586";
        self::$client = new Client(['base_uri' => 'https://www.strava.com/api/v3/']);
    }

    public static function get($url, $config)
    {
        $result = self::$client->get($url, $config);
        $content = $result->getBody()->getContents();
        return \GuzzleHttp\json_decode($content);
    }

    public static function redirectToStrava()
    {
        return 'https://www.strava.com/oauth/authorize' .
            '?client_id=20586' .
            '&redirect_uri=http://192.168.10.10/login/callback' .
            '&response_type=code' .
            '&approval_prompt=auto' .
            '&scope=public';
    }

    public static function finalizeLogin($code)
    {
        $client = new Client(['base_uri' => 'https://www.strava.com/']);

        $res = $client->request(
            'POST',
            'oauth/token',
            ['query' => http_build_query([
                "client_id" => "20586",
                "client_secret" => "a330975d3dfb689a84cb382d18d1dbc0e85392c3",
                "code" => $code
            ])]
        );

        return \GuzzleHttp\json_decode($res->getBody()->getContents());
    }


    public function updateUserActivities($u)
    {

        $user = $u;

        $activities = Strava::get('athlete/activities', ['query' => 'access_token=' . $user->token]);
        foreach ($activities as $activity) {
            Activity::updateOrCreate(
                ['activityId' => $activity->id],
                ['name' => $activity->name, 'distance' => $activity->distance, 'user_id' => $user->id, 'moving_time' => $activity->moving_time, 'start_date' => $activity->start_date]
            );

            //TODO remove activities from database when removed in Strava
            //Activity::where('activityId', "!=" , $apiResult->id)->delete();

        }
    }
}
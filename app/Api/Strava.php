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
        self::$client_secret = env('STRAVA_SECRET');
        self::$client_id = env('STRAVA_ID');
        self::$client = new Client(['base_uri' => 'https://www.strava.com/api/v3/']);
    }

    public static function get($url, $config)
    {
        $result = self::$client->get($url, $config);
        $content = $result->getBody()->getContents();
        return \GuzzleHttp\json_decode($content);
    }

    public static function post($url, $config)
    {
        $result = self::$client->post($url, $config);
        $content = $result->getBody()->getContents();
        return \GuzzleHttp\json_decode($content);
    }

    public static function redirectToStrava()
    {
        return 'https://www.strava.com/oauth/authorize' .
            '?client_id=' . self::$client_id .
            '&redirect_uri=' . env('STRAVA_REDIRECT') .
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
                "client_id" => self::$client_id,
                "client_secret" => self::$client_secret,
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
            if($activity->manual == 0) {
                Activity::updateOrCreate(
                    ['activityId' => $activity->id],
                    ['name' => $activity->name, 'type' => $activity->type, 'manual' => $activity->manual, 'distance' => $activity->distance, 'user_id' => $user->id, 'moving_time' => $activity->moving_time, 'start_date' => $activity->start_date]
                );
            }
        }
    }
}
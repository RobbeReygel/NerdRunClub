<?php

namespace App;

use GuzzleHttp\Client;

class Strava {
    public function __construct($token)
    {
        $this->redirect_uri = "http://192.168.10.10/login/callback";
        $this->client_secret = "a330975d3dfb689a84cb382d18d1dbc0e85392c3";
        $this->client_id = "20586";
        $this->token = $token;
        $this->client = new Client(['base_uri' => 'https://www.strava.com/api/v3/']);
    }

    public static function redirectToStrava () {
        return 'https://www.strava.com/oauth/authorize' .
            '?client_id=20586' .
            '&redirect_uri=http://192.168.10.10/login/callback' .
            '&response_type=code' .
            '&approval_prompt=auto' .
            '&scope=public';
    }

    public static function finalizeLogin($code) {
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

    public function getLoggedInUser() {
        $res = $this->client->request(
            'GET',
            'athlete',
            ['query' => 'access_token=' . $this->token]
        );

        return \GuzzleHttp\json_decode($res->getBody()->getContents());
    }

    public function updateUserActivities() {

        $users = User::all();

        foreach ($users as $user)
        {
            $token = $user->token;

            $client = new \GuzzleHttp\Client();

            $res = $client->request('GET', 'https://www.strava.com/api/v3/athlete/activities',
                ['query' => http_build_query([
                    "access_token" => $token
                ])]);

            $apiResults = json_decode($res->getBody(), false);

            foreach ($apiResults as $apiResult)
            {

                Activity::updateOrCreate(
                    ['activityId' => $apiResult->id],
                    ['name' => $apiResult->name, 'distance' => $user->distance, 'userid' => $user->id, 'moving_time' => $user->moving_time, 'start_date' => $user->start_date]
                );

                //TODO remove activities from database when removed in Strava
                //Activity::where('activityId', "!=" , $apiResult->id)->delete();

            }

        }

    }
}
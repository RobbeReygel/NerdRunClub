<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {

    return [
        'strava_id' => mt_rand(10000000, 99999999),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'sex' => "X",
        'avatar' => "https://goo.gl/pBByBv",
        'email' => $faker->unique()->safeEmail,
        'token' => "7de8ff22af9c5c43a5ddcf03b1e8b1aab30b2d8f",
    ];
});

$factory->define(App\Activity::class, function (Faker $faker) {

    $date = $faker->date($format = 'Y-m-d', $max = 'now');
    $t = "T";
    $time = $faker->time($format = 'H:i:s', $max = 'now');
    $z = "Z";
    $startDate = $date . $t . $time . $z;

    return [
        'activityId' => mt_rand(1000000000, 1999999999),
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'name' => $faker->randomElement($array = array ('Ochtend run','Avondloop','Middag run')),
        'distance' => $faker->numberBetween($min = 100, $max = 50000),
        'moving_time' => $faker->numberBetween($min = 100, $max = 50000),
        'start_date' => $startDate
    ];
});


<?php

use Faker\Generator as Faker;
use Carbon\Carbon;



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
        'strava_id' => $faker->numberBetween($min = 10000000, $max = 99999999),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'sex' => $faker->randomElement($array = array ('M','V')),
        'avatar' => $faker->imageUrl($width = 250, $height = 250, 'people'),
        'email' => $faker->unique()->safeEmail,
        'token' => "7de8ff22af9c5c43a5ddcf03b1e8b1aab30b2d8f",
    ];
});

$factory->define(App\Activity::class, function (Faker $faker) {
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $day = Carbon::now()->day;
    $date2 = $day - mt_rand(1, ($day-1));
    if($date2<10){
        $date2= "0".$date2;
    }
    $date = $year.'-'.$month.'-'.$date2;
    $t = "T";
    $time = $faker->time($format = 'H:i:s', $max = 'now');
    $z = "Z";
    $startDate = $date . $t . $time . $z;

    return [
        'activityId' => $faker->numberBetween($min = 1000000000, $max = 1999999999),
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'name' => $faker->randomElement($array = array ('Ochtend run','Avondloop','Middag run')),
        'type' => $faker->randomElement($array = array ('Run','Run','Run','Hike','Swim')),
        'manual' => $faker->randomElement($array = array ('0','1')),
        'distance' => $faker->numberBetween($min = 100, $max = 50000),
        'moving_time' => $faker->numberBetween($min = 100, $max = 50000),
        'start_date' => $startDate
    ];
});


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
    static $password;

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

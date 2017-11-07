<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Activity;
use Illuminate\Support\Carbon;

class User  extends Authenticatable
{

    protected $fillable = ['strava_id', 'first_name', 'last_name', 'sex', 'avatar', 'email', 'token'];

    public function activities() {
        return $this->hasMany('App\Activity');
    }


    public function totalDistance()
    {
        return $this->hasMany('App\Activity')
            ->selectRaw('user_id, sum(distance) as sum_distance')
            ->groupBy('user_id');
    }

    public function totalTime()
    {
        return $this->hasMany('App\Activity')
            ->selectRaw('user_id, sum(moving_time) as sum_time')
            ->groupBy('user_id');
    }

    public function totalDistanceWeekly()
    {
        return $this->hasMany('App\Activity')
            ->selectRaw('user_id, sum(distance) as sum_distance')
            ->groupBy('user_id')
            ->where('created_at', '>=', Carbon::now()->subDay(7));
    }

    public function totalTimeWeekly()
    {
        return $this->hasMany('App\Activity')
            ->selectRaw('user_id, sum(moving_time) as sum_time')
            ->groupBy('user_id')
            ->where('created_at', '>=', Carbon::now()->subDay(7));
    }

}

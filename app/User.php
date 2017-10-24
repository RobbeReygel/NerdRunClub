<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Activity;

class User  extends Authenticatable
{

    protected $fillable = ['strava_id', 'first_name', 'last_name', 'sex', 'avatar', 'email', 'token'];

    public function activities() {
        return $this->hasMany('App\Activity');
    }

    public function sumDistance()
    {
        return $this->hasMany('App\Activity')
            ->selectRaw('user_id, sum(distance) as sum_distance')
            ->groupBy('user_id');
            //->orderBy('sum_distance', 'desc');
    }
}

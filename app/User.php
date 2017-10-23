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
        return $this->belongsToMany('Activity', 'activities', 'user_id', 'activityId')
            ->selectRaw('user_id, sum(activities.distance) as sum_distance')
            ->groupBy('users.strava_id')
            ->orderBy('sum_distance', 'desc');
    }

    public function getSumDistance()
    {
        // if relation is not loaded already, let's do it first
        if (!array_key_exists('sumDistance', $this->relations)) {
            $this->load('sumDistance');
        }

        $related = $this->getRelation('sumDistance')->first();
        // then return the count directly
        return ($related) ? (int) $related->sum_distance : 0;
    }
}

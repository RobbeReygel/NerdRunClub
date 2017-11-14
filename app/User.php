<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User  extends Authenticatable
{

    use Notifiable;

    protected $fillable = ['strava_id', 'first_name', 'last_name', 'sex', 'avatar', 'email', 'token'];

    public function activities() {
        return $this->hasMany('App\Activity');
    }

    public function lastActivity() {
        return $this->hasMany('App\Activity')
            ->orderBy('created_at', 'desc');
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
        $monday = Carbon::now()->startOfWeek();
        $sunday = Carbon::now()->endOfWeek();

        return $this->hasMany('App\Activity')
            ->selectRaw('user_id, sum(distance) as sum_distance')
            ->groupBy('user_id')
            ->where('start_date', '>=', $monday)
            ->where('start_date', '<=', $sunday);
    }

    public function totalTimeWeekly()
    {
        $monday = Carbon::now()->startOfWeek();
        $sunday = Carbon::now()->endOfWeek();

        return $this->hasMany('App\Activity')
            ->selectRaw('user_id, sum(moving_time) as sum_time')
            ->groupBy('user_id')
            ->where('start_date', '>=', $monday)
            ->where('start_date', '<=', $sunday);
    }

    public function getRanPreviousWeek() {
        $monday = Carbon::now()->subDay(7)->startOfWeek();
        $sunday = Carbon::now()->subDay(7)->endOfWeek();

        return Auth::user()->activities
            ->where('start_date', '>=', $monday)
            ->where('start_date', '<=', $sunday);
    }


    public function getRanThisWeek() {
        $monday = Carbon::now()->startOfWeek();
        $sunday = Carbon::now()->endOfWeek();

        return Auth::user()->activities
            ->where('start_date', '>=', $monday)
            ->where('start_date', '<=', $sunday);
    }

}

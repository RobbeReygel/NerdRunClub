<?php

namespace App;

use App\Notifications\MedalReceived;
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
        return $this->hasMany('App\Activity')->where('type', 'Run');
    }

    public function medals() {
        return $this->hasMany('App\Medal');
    }

    public function lastActivity() {
        return $this->hasMany('App\Activity')
            ->where('type', 'Run')
            ->orderBy('created_at', 'desc');
    }

    public function totalDistance()
    {
        return $this->hasMany('App\Activity')
            ->where('type', 'Run')
            ->selectRaw('user_id, sum(distance) as sum_distance')
            ->groupBy('user_id');
    }

    public function totalTime()
    {
        return $this->hasMany('App\Activity')
            ->where('type', 'Run')
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
            ->where('type', 'Run')
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
            ->where('type', 'Run')
            ->where('start_date', '>=', $monday)
            ->where('start_date', '<=', $sunday);
    }

    public function getRanPreviousWeek() {
        $monday = Carbon::now()->subDay(7)->startOfWeek();
        $sunday = Carbon::now()->subDay(7)->endOfWeek();

        return $this->activities
            ->where('type', 'Run')
            ->where('start_date', '>=', $monday)
            ->where('start_date', '<=', $sunday);
    }


    public function getRanThisWeek() {
        $monday = Carbon::now()->startOfWeek();
        $sunday = Carbon::now()->endOfWeek();

        return $this->activities
            ->where('type', 'Run')
            ->where('start_date', '>=', $monday)
            ->where('start_date', '<=', $sunday);
    }
    public function scopeSearch($query, $keyword)
    {
        return $query->where('first_name', 'like', '%' .$keyword. '%')
            ->orWhere('last_name', 'like', '%' .$keyword. '%');
    }

    public function giveMedal() {
        $this_week = Medal::where('week', '=', date('W', time()))
            ->where('year', '=', date('Y', time()))
            ->where('user_id', '=', $this->id)
            ->first();

        if ($this_week == null) {
            $this->createMedal();
        } else {
            $this->updateMedal($this_week);
        }
    }

    public function updateMedal($medal) {
        $previousWeek = $this->getRanPreviousWeek();
        $thisWeek = $this->getRanThisWeek();

        $totalRanPreviousWeek = 0;
        foreach ($previousWeek as $a) {
            $totalRanPreviousWeek += $a->distance;
        }

        $totalRanThisWeek = 0;
        foreach ($thisWeek as $a) {
            $totalRanThisWeek += $a->distance;
        }

        $goalThisWeek = round(($totalRanPreviousWeek * 1.1) / 1000);
        if ($goalThisWeek < 3)
            $goalThisWeek = 3;

        $perc = round(($totalRanThisWeek / 1000) / $goalThisWeek * 100);

        if ($perc >= 25 && $perc < 50) {
            $medal->type = "bronze";
            $medal->short_name = "WEEKLY";
            $medal->long_name = "Weekly reward 25%";
        } else if ($perc >= 50 && $perc < 100) {
            $medal->type = "silver";
            $medal->short_name = "WEEKLY";
            $medal->long_name = "Weekly reward 50%";
        } else if ($perc >= 100) {
            $medal->type = "gold";
            $medal->short_name = "WEEKLY";
            $medal->long_name = "Weekly reward 100%";
        }

        $medal->save();
    }

    public function createMedal() {
        $previousWeek = $this->getRanPreviousWeek();
        $thisWeek = $this->getRanThisWeek();

        $totalRanPreviousWeek = 0;
        foreach ($previousWeek as $a) {
            $totalRanPreviousWeek += $a->distance;
        }

        $totalRanThisWeek = 0;
        foreach ($thisWeek as $a) {
            $totalRanThisWeek += $a->distance;
        }

        $goalThisWeek = round(($totalRanPreviousWeek * 1.1) / 1000);
        if ($goalThisWeek < 3)
            $goalThisWeek = 3;

        $perc = round(($totalRanThisWeek / 1000) / $goalThisWeek * 100);
        $medal = new Medal();
        $medal->week = date('W', time());
        $medal->year = date('Y', time());

        if ($perc >= 25 && $perc < 50) {
            $medal->type = "bronze";
            $medal->short_name = "WEEKLY";
            $medal->long_name = "Weekly reward 25%";
            $medal->user_id = $this->id;
        } else if ($perc >= 50 && $perc < 100) {
            $medal->type = "silver";
            $medal->short_name = "WEEKLY";
            $medal->long_name = "Weekly reward 50%";
            $medal->user_id = $this->id;
        } else if ($perc >= 100) {
            $medal->type = "gold";
            $medal->short_name = "WEEKLY";
            $medal->long_name = "Weekly reward 100%";
            $medal->user_id = $this->id;
        }

        $medal->save();
        $this->notify(new MedalReceived());
    }
}

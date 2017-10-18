<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends model
{

    protected $fillable = ['activityId', 'user_id', 'name', 'distance', 'moving_time', 'start_date'];

    public function user() {
        $this->hasOne('App\User');
    }

}

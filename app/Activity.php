<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity  extends model
{

    protected $fillable = ['activityId', 'userid', 'name', 'distance', 'moving_time', 'start_date'];

}
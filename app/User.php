<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User  extends Authenticatable
{

    protected $fillable = ['strava_id', 'first_name', 'last_name', 'sex', 'avatar', 'email', 'token'];

}

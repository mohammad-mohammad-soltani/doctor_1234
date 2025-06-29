<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class origin extends Authenticatable
{
    protected $table = "origins";
    protected $fillable = ['name' , 'password' , 'clinic_id' , 'username'];

}

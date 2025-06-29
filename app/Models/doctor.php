<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class doctor extends Authenticatable
{
    protected $table = "doctors";
    protected $fillable = ['name' , 'password' , 'clinic_id' , 'username'];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = "managers";

    protected $fillable = ['name'  ,'username' , 'password'];
}

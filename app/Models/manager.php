<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class manager extends Authenticatable
{
    protected $table = "managers";
}

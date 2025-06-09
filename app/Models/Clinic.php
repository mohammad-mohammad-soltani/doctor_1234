<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $table = "clinic";
    protected $fillable = ['name', 'doctors', 'origins'];

    protected $casts = [
        'doctors' => 'array',
        'origins' => 'array',
    ];
}

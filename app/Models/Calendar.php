<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';
    protected $fillable = ['name' , 'clinic_id' , 'doctor' , 'time' , 'requirements' , 'price' , 'number' , 'payment_way' , 'timeofwork' , 'payment_status' , 'introduce_way' , 'product_line'];
}

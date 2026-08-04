<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configurations extends Model
{
    protected $fillable = ['name', 'logo', 'description', 'start_time', 'end_time'];
}

<?php

namespace App\Models;

use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Model;

class UsersVehicles extends Model
{
//    use ScopeTrait;

    protected $fillable = ['user_id', 'name', 'brand', 'plate', 'color', 'type_vehicle_id', 'year', 'default'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

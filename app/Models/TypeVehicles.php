<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeVehicles extends Model
{
    protected $fillable = ['name', 'description'];

    public function services()
    {
        return $this->hasMany(Services::class, 'type_vehicle_id');
    }
}

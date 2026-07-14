<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillable = ['type_vehicle_id', 'name', 'description', 'price'];

    public function type()
    {
        return $this->belongsTo(TypeVehicles::class, 'type_vehicle_id');

    }
}

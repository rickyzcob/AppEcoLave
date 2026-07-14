<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class UserCommittees extends Model
{
    protected $fillable = ['user_id', 'order_id', 'value', 'percentage', 'value_commission', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'canceled' => 'Cancelado',
                'pending' => 'Pendente',
                'credited' => 'Creditado',
            },
        );
    }

    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'canceled' => 'red',
                'pending' => 'orange',
                'credited' => 'green',
            },
        );
    }
}

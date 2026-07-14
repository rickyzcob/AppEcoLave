<?php

namespace App\Models;

use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Withdrawals extends Model
{

    protected $fillable = ['user_id', 'amount', 'status', 'key_pix', 'file_path', 'proof_number', 'observations'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'pending' => 'Pendente',
                'overdue' => 'Em Atraso',
                'paid' => 'Pago',
                'error' => 'Erro',
            },
        );
    }

    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'pending' => 'yellow',
                'overdue' => 'orange',
                'paid' => 'green',
                'error' => 'red',
            },
        );
    }
}

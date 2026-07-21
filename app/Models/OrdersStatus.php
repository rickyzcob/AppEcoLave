<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class OrdersStatus extends Model
{
    protected $fillable = ['order_id', 'status', 'description'];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'received' => 'Pedido Recebido',
                'accepted' => 'Pedido Aceito',
                'canceled' => 'Serviço Cancelado',
                'on_the_way' => 'A Caminho',
                'arrived_location' => 'Cheguei ao Local',
                'service_started' => 'Lavagem foi iniciada',
                'service_finish' => 'Serviço Finalizado',
            },
        );
    }

    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'received' => 'orange',
                'accepted' => 'blue',
                'canceled' => 'red',
                'on_the_way' => 'sky',
                'arrived_location' => 'teal',
                'service_started' => 'violet',
                'service_finish' => 'green',
            },
        );
    }

    protected function statusIcon(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'accepted' => 'fa-check',
                'on_the_way' => 'fa-motorcycle',
                'arrived_location' => 'fa-location-dot',
                'service_started' => 'fa-spray-can',
                'service_finish' => 'fa-flag-checkered',
            },
        );
    }
}

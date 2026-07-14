<?php

namespace App\Models;

use App\Services\Reference\ReferenceService;
use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use ScopeTrait;

    protected $fillable = [
        'user_id', 'washer_id', 'service_id', 'reference',
        'zip_code', 'street', 'number', 'complement',
        'neighborhood',  'city', 'uf', 'status', 'price', 'status_washer', 'date_scheduled',
        'vehicle_plate', 'vehicle', 'comment', 'rate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function washer()
    {
        return $this->belongsTo(User::class, 'washer_id');
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id');
    }

    public function committee()
    {
        return $this->belongsTo(UserCommittees::class, 'order_id');
    }


    protected static function booted()
    {
        $referenceService = new ReferenceService();
        static::creating(fn(Orders $order) => $order->reference = $referenceService->getReference());
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'new' => 'Novo Pedido',
                'waiting' => 'Aguardando resposta',
                'accepted' => 'Pedido Aceito',
                'scheduled' => 'Agendamento Confirmado',
                'canceled' => 'Serviço Cancelado',
                'on_the_way' => 'A Caminho',
                'arrived_location' => 'Cheguei ao Local',
                'service_started' => 'Lavagem foi iniciada',
                'service_finish' => 'Serviço Finalizado',
                'concluded' => 'Concluído',
            },
        );
    }

    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'new' => 'sky',
                'waiting' => 'orange',
                'scheduled' => 'blue',
                'accepted' => 'blue',
                'canceled' => 'red',
                'concluded' => 'green',
                'on_the_way' => 'blue',
                'arrived_location' => 'teal',
                'service_started' => 'violet',
                'service_finish' => 'green',
            },
        );
    }


    protected function statusWasherLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status_washer) {
                'new' => 'Novo',
                'waiting' => 'Aguardando resposta',
                'accepted' => 'Aceito',
                'declined' => 'Recusado',
                'progress' => 'Em andamento',
                'finish' => 'Finalizado',
            },
        );
    }

    protected function statusWasherColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status_washer) {
                'new' => 'blue',
                'waiting' => 'yellow',
                'accepted' => 'lime',
                'declined' => 'red',
                'progress' => 'orange',
                'finish' => 'green',
            },
        );
    }
}

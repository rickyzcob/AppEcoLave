<?php

namespace App\Models;

use App\Services\Reference\ReferenceService;
use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Orders extends Model
{
    use ScopeTrait;

    protected $fillable = [
        'vehicle_id', 'user_id', 'washer_id', 'service_id', 'reference', 'observations',
        'zip_code', 'street', 'number', 'complement',
        'neighborhood',  'city', 'uf', 'status', 'price', 'status_washer',
        'vehicle_plate', 'vehicle', 'comment', 'rate', 'date_schedule', 'hour_schedule'
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

    public function vehicle()
    {
        return $this->belongsTo(UsersVehicles::class, 'vehicle_id');
    }

    public function statuses()
    {
        return $this->hasMany(OrdersStatus::class, 'order_id');
    }

    public function review()
    {
        return $this->hasOne(UsersReviews::class, 'order_id');
    }


    protected function weekDay(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->date_schedule)
                ->locale('pt_BR')
                ->translatedFormat('l')
        );
    }

    protected function percentageComplete(): Attribute
    {
        return Attribute::make(
            get: function () {

                if (!$this->relationLoaded('statuses')) {
                    return 0;
                }

                $total = $this->statuses->count();
                $completed = $this->statuses->whereIn('description', ['completed', 'active'])->count();

                return $total > 0
                    ? round(($completed / $total) * 100, 0)
                    : 0;
            }
        );
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
                'on_the_way' => 'yellow',
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
                'waiting' => 'Aguardando resposta',
                'accepted' => 'Aceito',
                'declined' => 'Recusado',
                'progress' => 'Em andamento',
                'finish' => 'Finalizado',
                'canceled' => 'Cancelado',
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
                'canceled' => 'red',
            },
        );
    }
}

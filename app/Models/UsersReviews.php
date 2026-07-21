<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersReviews extends Model
{
    protected $fillable = ['owner_id', 'client_id', 'washer_id', 'order_id', 'comment', 'rate', 'type'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function washer()
    {
        return $this->belongsTo(User::class, 'washer_id');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }


}

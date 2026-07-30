<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name', 'phone', 'email', 'password','taxpayer_registration', 'zip_code',
    'address', 'number','complement', 'neighborhood', 'avatar', 'google_id', 'status',
    'city', 'uf', 'scope', 'is_online', 'bank_name', 'key_pix', 'value_commission',
    'committee_id', 'profile_photo_path','asaas_id'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    public function orders()
    {
        return $this->hasMany(Orders::class, 'user_id');
    }

    public function committee()
    {
        return $this->belongsTo(Committees::class, 'committee_id');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawals::class, 'user_id');
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'active' => 'Ativo',
                'inactive' => 'Inativo',
            },
        );
    }

    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'inactive' => 'red',
                'active' => 'green',
            },
        );
    }

    protected function statusUser(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->is_online) {
                'online' => 'Online',
                'offline' => 'Offline',
                'ocupied' => 'Ocupado',
            },
        );
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn () => explode(' ', trim($this->name))[0] ?? ''
        );
    }
}

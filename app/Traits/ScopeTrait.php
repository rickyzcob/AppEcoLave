<?php

namespace App\Traits;

use App\Manager\ScopeManager;

trait ScopeTrait
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->user_id)) {
                $model->user_id =  auth()->id();
            }
        });

        static::addGlobalScope('scope', function ($query) {
            // Evita loop no modelo User
            if (static::class === \App\Models\User::class) return;

            // Evita erro no console/jobs sem autenticação
//            if (!Auth::check()) return;

            try {

                $scope = app(ScopeManager::class)->getScopeIdentify();

                if ($scope === 'client') {
                    $query->where(
                        (new static)->getTable() . '.user_id',
                        auth()->id()
                    );
                }
                if ($scope === 'washer') {
                    $query->where(
                        (new static)->getTable() . '.washer_id',
                        auth()->id()
                    );
                }
            } catch (\Throwable $e) {
                //
            }
        });
    }
}

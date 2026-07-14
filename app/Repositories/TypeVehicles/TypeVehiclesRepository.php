<?php

namespace App\Repositories\TypeVehicles;

use App\Models\TypeVehicles;
use App\Models\User;
use PHPUnit\Exception;

class TypeVehiclesRepository
{
    public function index()
    {
        try {
            $typeVehiclesDB = TypeVehicles::query()->get();

            return [
                'status' => 'success',
                'data' => $typeVehiclesDB,
                'code' => 200
            ];

        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Indexar'
            ];
        }
    }
}

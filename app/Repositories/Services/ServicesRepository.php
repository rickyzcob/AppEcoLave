<?php

namespace App\Repositories\Services;

use App\Models\Services;
use App\Models\TypeVehicles;
use PHPUnit\Exception;

class ServicesRepository
{
    public function index($type_vehicle_id)
    {
        try {

            $servicesDB = Services::query();

            if($type_vehicle_id) {
                $servicesDB->where('type_vehicle_id', $type_vehicle_id);
            }


            $servicesDB = $servicesDB->get();

            return [
                'status' => 'success',
                'data' => $servicesDB,
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


    public function show($service_id)
    {
        try {

            $servicesDB = Services::query()->with(['type'])->findOrFail($service_id);

            return [
                'status' => 'success',
                'data' => $servicesDB,
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

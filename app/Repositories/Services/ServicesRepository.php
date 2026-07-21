<?php

namespace App\Repositories\Services;

use App\Models\Services;
use App\Models\TypeVehicles;
use App\Models\UsersVehicles;
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

    public function getSelectServices($user_vehicle_id = null)
    {
        $servicesDB = Services::query();

        if($user_vehicle_id) {
            $userVehicleDB = UsersVehicles::query()->find($user_vehicle_id);
            $servicesDB->where('type_vehicle_id', $userVehicleDB['type_vehicle_id']);
        }

        $servicesDB = $servicesDB->get();

        $return = [];

        foreach ($servicesDB as $key => $itemService) {
            $return[$key + 1]['label'] = $itemService['name']. ' - '. formatMoney($itemService['price']);
            $return[$key + 1]['value'] = $itemService['id'];
        }

        return $return;


    }

}

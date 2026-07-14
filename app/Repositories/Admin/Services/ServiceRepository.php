<?php

namespace App\Repositories\Admin\Services;

use App\Models\Services;
use App\Models\TypeVehicles;
use App\Requests\Admin\ClientRequest;
use App\Requests\Admin\ServiceRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ServiceRepository
{
    public function index($type_id = null, $filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $servicesDB = Services::query();

            $servicesDB->where('type_vehicle_id', $type_id);

            if($orderBy) {
                $servicesDB->orderBy($orderBy['column'], $orderBy['order']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $servicesDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if($pageSize) {
                $servicesDB = $servicesDB->paginate($pageSize);
            } else {
                $servicesDB = $servicesDB->get();
            }

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

    public function create($type_id, $request)
    {
        $serviceRequest = new ServiceRequest();
        $requestValidated = $serviceRequest->validate($request);

        try {
            $typeVehicle = TypeVehicles::query()->with(['services'])->find($type_id);

            $servicesDB = $typeVehicle->services()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $servicesDB,
                'code' => 200,
                'message' => 'Serviço cadastrado com sucesso !'
            ];

        } catch (Exception $exception){
            return [
                'status' => 'error',
                'data' => $exception,
                'code' => 400,
                'message' => 'Erro ao Cadastrar'
            ];
        }
    }

    public function update($id, $request)
    {
        $serviceRequest = new ServiceRequest();
        $requestValidated = $serviceRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $servicesDB = Services::query()->findOrFail($id);
            $servicesDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $servicesDB,
                'code' => 200,
                'message' => 'Serviço atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {
            DB::rollback();
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function show($id)
    {
        try {
            $servicesDB = Services::query()->find($id);

            return [
                'status' => 'success',
                'data' => $servicesDB,
                'code' => 200,

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }

    public function delete($id = null)
    {
        try {
            DB::beginTransaction();

            $servicesDB = Services::query()->findOrFail($id);
            $servicesDB->delete();

            DB::commit();
            return [
                'status' => 'success',
                'data' => $servicesDB,
                'code' => 200,
                'message' => 'Serviço deletado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }
    public function getSelectServices($type_id = null)
    {
        $servicesDB = Services::query()->orderBy('name', 'ASC');

        $return = [];


        if($type_id) {
            $servicesDB->where('type_vehicle_id', $type_id);
            $servicesDB = $servicesDB->get();


            foreach ($servicesDB as $key => $itemUser) {
                $return[$key + 1]['label'] = $itemUser['name'] .' - '. formatMoney($itemUser['price']);
                $return[$key + 1]['value'] = $itemUser['id'];
            }
        }

        return $return;
    }

}

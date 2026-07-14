<?php

namespace App\Repositories\Admin\Services;

use App\Models\TypeVehicles;
use App\Requests\Admin\TypeVehicleRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class TypeVehiclesRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $typeVehicleDB = TypeVehicles::query();

            if($orderBy) {
                $typeVehicleDB->orderBy($orderBy['column'], $orderBy['order']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $typeVehicleDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if($pageSize) {
                $typeVehicleDB = $typeVehicleDB->paginate($pageSize);
            } else {
                $typeVehicleDB = $typeVehicleDB->get();
            }

            return [
                'status' => 'success',
                'data' => $typeVehicleDB,
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

    public function create($request)
    {
        $typeVehicleRequest = new TypeVehicleRequest();
        $requestValidated = $typeVehicleRequest->validate($request);

        try {
            $typeVehicleDB = TypeVehicles::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $typeVehicleDB,
                'code' => 200,
                'message' => 'Tipo de veículo cadastrado com sucesso !'
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
        $typeVehicleRequest = new TypeVehicleRequest();
        $requestValidated = $typeVehicleRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $typeVehicleDB = TypeVehicles::query()->findOrFail($id);
            $typeVehicleDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $typeVehicleDB,
                'code' => 200,
                'message' => 'Tipo de Serviço atualizado com sucesso !'
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
            $typeVehicleDB = TypeVehicles::query()->find($id);

            return [
                'status' => 'success',
                'data' => $typeVehicleDB,
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

            $typeVehicleDB = TypeVehicles::query()->findOrFail($id);
            $typeVehicleDB->delete();

            DB::commit();
            return [
                'status' => 'success',
                'data' => $typeVehicleDB,
                'code' => 200,
                'message' => 'Tipo de serviço deletado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }
    public function getSelectTypeVehicle($tenant_id = null)
    {
        $typeVehicleDB = TypeVehicles::query()->orderBy('name', 'ASC');

        $typeVehicleDB = $typeVehicleDB->get();

        $return = [];

        foreach ($typeVehicleDB as $key => $itemUser) {
            $return[$key + 1]['label'] = $itemUser['name'];
            $return[$key + 1]['value'] = $itemUser['id'];
        }

        return $return;
    }

}

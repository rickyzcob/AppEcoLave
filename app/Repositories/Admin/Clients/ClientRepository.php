<?php

namespace App\Repositories\Admin\Clients;

use App\Models\User;
use App\Requests\Admin\ClientRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ClientRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $clientsDB = User::query()
                ->withCount('orders as orders_count')
                ->withoutGlobalScope('scope');

            $clientsDB->where('scope', 'client');

            if($orderBy) {
                $clientsDB->orderBy($orderBy['column'], $orderBy['order']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $clientsDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if($pageSize) {
                $clientsDB = $clientsDB->paginate($pageSize);
            } else {
                $clientsDB = $clientsDB->get();
            }

            return [
                'status' => 'success',
                'data' => $clientsDB,
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
        $clientsRequest = new ClientRequest();
        $requestValidated = $clientsRequest->validate($request);

        try {
            $clientsDB = User::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $clientsDB,
                'code' => 200,
                'message' => 'Cliente cadastrado com sucesso !'
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
        $clientsRequest = new ClientRequest();
        $requestValidated = $clientsRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $clientsDB = User::query()->findOrFail($id);
            $clientsDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $clientsDB,
                'code' => 200,
                'message' => 'Cliente atualizado com sucesso !'
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
            $clientsDB = User::query()->find($id);

            return [
                'status' => 'success',
                'data' => $clientsDB,
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

            $clientsDB = User::query()->findOrFail($id);
            $clientsDB->delete();

            DB::commit();
            return [
                'status' => 'success',
                'data' => $clientsDB,
                'code' => 200,
                'message' => 'Cliente deletado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }
    public function getSelectClient($tenant_id = null)
    {
        $clientsDB = User::query()->orderBy('name', 'ASC');

        $clientsDB = $clientsDB->get();

        $return = [];

        foreach ($clientsDB as $key => $itemUser) {
            $return[$key + 1]['label'] = $itemUser['name'];
            $return[$key + 1]['value'] = $itemUser['id'];
        }

        return $return;
    }

}

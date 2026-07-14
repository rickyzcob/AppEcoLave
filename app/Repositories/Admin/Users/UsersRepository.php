<?php

namespace App\Repositories\Admin\Users;

use App\Models\Orders;
use App\Models\User;
use App\Requests\Admin\ClientRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class UsersRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $usersDB = User::query()
                ->withoutGlobalScope('scope');

            $usersDB->where('scope', 'admin');

            if($orderBy) {
                $usersDB->orderBy($orderBy['column'], $orderBy['order']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $usersDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if($pageSize) {
                $usersDB = $usersDB->paginate($pageSize);
            } else {
                $usersDB = $usersDB->get();
            }

            return [
                'status' => 'success',
                'data' => $usersDB,
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
            $requestValidated['scope'] = 'admin';
            $usersDB = User::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $usersDB,
                'code' => 200,
                'message' => 'Usuário cadastrado com sucesso !'
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

            $usersDB = User::query()->findOrFail($id);
            $usersDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $usersDB,
                'code' => 200,
                'message' => 'Usuário atualizado com sucesso !'
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
            $usersDB = User::query()->find($id);

            return [
                'status' => 'success',
                'data' => $usersDB,
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

            $usersDB = User::query()->findOrFail($id);
            $usersDB->delete();

            DB::commit();
            return [
                'status' => 'success',
                'data' => $usersDB,
                'code' => 200,
                'message' => 'Usuário deletado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }
    public function getSelectUsers($tenant_id = null)
    {
        $usersDB = User::query()->orderBy('name', 'ASC');

        $usersDB = $usersDB->get();

        $return = [];

        foreach ($usersDB as $key => $itemUser) {
            $return[$key + 1]['label'] = $itemUser['name'];
            $return[$key + 1]['value'] = $itemUser['id'];
        }

        return $return;
    }

    public function updateStatus($id, $status = null)
    {

        try {

            $usersDB = User::query()->findOrFail($id);

            $usersDB->update([
                'is_online' => $status
            ]);

            return [
                'status' => 'success',
                'data' => $usersDB,
                'code' => 200,
                'message' => 'Status do usuário atualizado com sucesso !'
            ];

        } catch (\Exception $exception) {

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao atualizar status'
            ];
        }
    }

}

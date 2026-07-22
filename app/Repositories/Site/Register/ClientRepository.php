<?php

namespace App\Repositories\Site\Register;

use App\Models\User;
use App\Requests\Register\ClientRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ClientRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $userDB = User::query();

            if($orderBy) {
                $userDB->orderBy($orderBy['column'], $orderBy['order']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $userDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if (isset($filterData['type']) && $filterData['type'] != null ) {
                $userDB->where('type', $filterData['type']);
            }


            if($pageSize) {
                $userDB = $userDB->paginate($pageSize);
            } else {
                $userDB = $userDB->get();
            }

            return [
                'status' => 'success',
                'data' => $userDB,
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
        $clientRequest = new ClientRequest();
        $requestValidated = $clientRequest->validate($request);

        try {
            $userDB = User::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $userDB,
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
        $clientRequest = new ClientRequest();
        $requestValidated = $clientRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $userDB = User::query()->findOrFail($id);
            $userDB->update($requestValidated);


            DB::commit();
            return [
                'status' => 'success',
                'data' => $userDB,
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
            $userDB = User::query()->find($id);

            return [
                'status' => 'success',
                'data' => $userDB,
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

            $userDB = User::query()->findOrFail($id);
            $userDB->delete();

            DB::commit();
            return [
                'status' => 'success',
                'data' => $userDB,
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

}

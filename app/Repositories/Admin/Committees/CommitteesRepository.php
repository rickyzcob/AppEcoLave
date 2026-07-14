<?php

namespace App\Repositories\Admin\Committees;

use App\Models\Committees;
use App\Models\User;
use App\Requests\Admin\CommitteesRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class CommitteesRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $committeesDB = Committees::query();

            if($orderBy) {
                $committeesDB->orderBy($orderBy['column'], $orderBy['order']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $committeesDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if($pageSize) {
                $committeesDB = $committeesDB->paginate($pageSize);
            } else {
                $committeesDB = $committeesDB->get();
            }

            return [
                'status' => 'success',
                'data' => $committeesDB,
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
        $committeeRequest = new CommitteesRequest();
        $requestValidated = $committeeRequest->validate($request);

        try {
            $committeesDB = Committees::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $committeesDB,
                'code' => 200,
                'message' => 'Comissão cadastrada com sucesso !'
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
        $committeeRequest = new CommitteesRequest();
        $requestValidated = $committeeRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $committeesDB = Committees::query()->findOrFail($id);
            $committeesDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $committeesDB,
                'code' => 200,
                'message' => 'Comissão atualizada com sucesso !'
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
            $committeesDB = Committees::query()->find($id);

            return [
                'status' => 'success',
                'data' => $committeesDB,
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

            $committeesDB = Committees::query()->findOrFail($id);
            $committeesDB->delete();

            DB::commit();
            return [
                'status' => 'success',
                'data' => $committeesDB,
                'code' => 200,
                'message' => 'Comissão deletada com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }
    public function getSelectCommittees($tenant_id = null)
    {
        $committeesDB = Committees::query()->orderBy('name', 'ASC');

        $committeesDB = $committeesDB->get();

        $return = [];

        foreach ($committeesDB as $key => $itemUser) {
            $return[$key + 1]['label'] = $itemUser['name'];
            $return[$key + 1]['value'] = $itemUser['id'];
        }

        return $return;
    }

}

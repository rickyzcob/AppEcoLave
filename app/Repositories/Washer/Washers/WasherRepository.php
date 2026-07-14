<?php

namespace App\Repositories\Washer\Washers;

use App\Models\User;
use App\Requests\Washer\WasherRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class WasherRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $washerDB = User::query()
                ->withCount('orders as orders_count')
                ->withoutGlobalScope('scope');

            $washerDB->where('scope', 'washer');


            if($orderBy) {
                $washerDB->orderBy($orderBy['column'], $orderBy['order']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $washerDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if($pageSize) {
                $washerDB = $washerDB->paginate($pageSize);
            } else {
                $washerDB = $washerDB->get();
            }

            return [
                'status' => 'success',
                'data' => $washerDB,
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
        $washerRequest = new WasherRequest();
        $requestValidated = $washerRequest->validate($request);

        try {
            $requestValidated['scope'] = 'washer';
            $washerDB = User::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $washerDB,
                'code' => 200,
                'message' => 'Profissional cadastrado com sucesso !'
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

        $washerRequest = new WasherRequest();
        $requestValidated = $washerRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $washerDB = User::query()->findOrFail($id);
            $washerDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $washerDB,
                'code' => 200,
                'message' => 'Profissional atualizado com sucesso !'
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
            $washerDB = User::query()->find($id);

            return [
                'status' => 'success',
                'data' => $washerDB,
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

            $washerDB = User::query()->findOrFail($id);
            $washerDB->delete();

            DB::commit();
            return [
                'status' => 'success',
                'data' => $washerDB,
                'code' => 200,
                'message' => 'Profissional deletado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }
    public function getSelectWasher()
    {
        $washerDB = User::query()
            ->where('scope', 'washer')
            ->orderBy('name', 'ASC');

        $washerDB = $washerDB->get();

        $return = [];

        foreach ($washerDB as $key => $itemUser) {
            $return[$key + 1]['label'] = $itemUser['name'] . ' - ' . $itemUser['statusUser'];
            $return[$key + 1]['value'] = $itemUser['id'];
        }

        return $return;
    }
}

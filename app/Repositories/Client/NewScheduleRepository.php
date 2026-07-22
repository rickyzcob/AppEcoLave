<?php

namespace App\Repositories\Client;

use App\Models\Orders;
use App\Models\OrdersStatus;
use App\Models\User;
use App\Repositories\Vendor\OrderStatusRepository;
use App\Requests\Admin\OrderRequest;
use App\Requests\Client\NewScheduleRequest;
use PHPUnit\Exception;

class NewScheduleRepository
{
    public function index($orderBy = null, $pageSize = null, $filterData = null)
    {
        try {
            $orderDB = Orders::query()->with(['service.type']);

            if($orderBy) {
                $orderDB->orderBy($orderBy['column'], $orderBy['direction']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $orderDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if (isset($filterData['type']) && $filterData['type'] != null ) {
                $orderDB->where('type', $filterData['type']);
            }

            if($pageSize) {
                $orderDB = $orderDB->simplePaginate($pageSize);
            } else {
                $orderDB = $orderDB->get();
            }

            return [
                'status' => 'success',
                'data' => $orderDB,
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

    public function create($client_id, $request)
    {
        $newScheduleRequest = new NewScheduleRequest();
        $requestValidated = $newScheduleRequest->validate($request);

        try {

            if($client_id) {
                $requestValidated['user_id'] = $client_id;
            } else {
                $userDB = User::query()->withoutGlobalScope('scope')->firstOrCreate(
                    [
                        'taxpayer_registration' => $requestValidated['user']['taxpayer_registration'],
                    ],
                    [
                        'name' => $requestValidated['user']['name'],
                        'email' => $requestValidated['user']['email'],
                        'phone' => $requestValidated['user']['phone'],
                        'taxpayer_registration' => $requestValidated['user']['taxpayer_registration']
                    ]
                );
                $requestValidated['user_id'] = $userDB['id'];
            }

            $orderDB = Orders::query()->create($requestValidated);

            $orderStatusRepository = new OrderStatusRepository();
            $orderStatusRepository->createStatusesByOrderId($orderDB->id);


            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'O pedido foi cadastrado com sucesso !'
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
        $newScheduleRequest = new OrderRequest();
        $requestValidated = $newScheduleRequest->validate($request, $id);

        try {

            $orderDB = Orders::query()->findOrFail($id);
            $orderDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Seu pedido foi atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {

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
            $orderDB = Orders::query()->with(['user', 'service'])->find($id);

            return [
                'status' => 'success',
                'data' => $orderDB,
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

    public function showByReference($reference, $user_id)
    {
        try {
            $orderDB = Orders::query()
                ->where('reference', $reference)
                ->where('user_id', $user_id)
                ->first();

            return [
                'status' => 'success',
                'data' => $orderDB,
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

            $orderDB = Orders::query()->findOrFail($id);
            $orderDB->delete();

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Pedido deletado com sucesso !'
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

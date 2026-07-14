<?php

namespace App\Repositories\Admin\Orders;

use App\Models\Committees;
use App\Models\Orders;
use App\Models\User;
use App\Models\UserCommittees;
use App\Requests\Admin\OrderRequest;
use PHPUnit\Exception;

class OrderRepository
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

    public function create($request, $client_id = null)
    {
        $orderRequest = new OrderRequest();
        $requestValidated = $orderRequest->validate($request);

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
        $orderRequest = new OrderRequest();
        $requestValidated = $orderRequest->validate($request, $id);

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

    public function updateStatus($id, $status = null)
    {
        try {

            $orderDB = Orders::query()->findOrFail($id);

            $orderDB->update([
                'status' => $status
            ]);

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Status do pedido atualizado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao atualizar status'
            ];
        }
    }

    public function updateFinish($id, $status = null)
    {
        try {

            $orderDB = Orders::query()->with([
                'washer.committee',
                'service',
                'committee'
            ])->findOrFail($id);

            $orderDB->update([
                'status_washer' => $status
            ]);

            $userCommitteeDB = UserCommittees::query()
                ->where('order_id', $orderDB['id'])
                ->where('user_id', $orderDB['washer_id'])
                ->first();

            $orderDB['washer']->increment('value_commission', $userCommitteeDB['value_commission']);

            $userCommitteeDB->update([
                'status' => 'credited'
            ]);


            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Pedido finalizado com sucesso !'
            ];

        } catch (\Exception $exception) {

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao atualizar status'
            ];
        }
    }

    public function updateProfessional($id, $washer_id = null)
    {
        try {

            $orderDB = Orders::query()->findOrFail($id);

            $userCommiteeDB = UserCommittees::query()
                ->where('order_id', $orderDB['id'])
                ->where('user_id', $orderDB['washer_id'])
                ->first();

            if($userCommiteeDB) {
                $userCommiteeDB->delete();
            }

            $orderDB->update([
                'washer_id' => $washer_id,
                'status' => 'waiting',
                'status_washer' => 'waiting'
            ]);

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Profissional atribuido com sucesso, aguardando o aceite !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao atualizar status'
            ];
        }
    }

    public function evaluate($id, $request, $quantity)
    {
        $orderRequest = new OrderRequest();
        $requesValidated = $orderRequest->validateEvaluate($request);

        try {

            $orderDB = Orders::query()->findOrFail($id);
            $orderDB->update([
                'comment' => $requesValidated['comment'],
                'rate' => $quantity
            ]);

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Status do pedido atualizado com sucesso !'
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

<?php

namespace App\Repositories\Order;

use App\Models\Orders;
use App\Models\User;
use App\Models\UserCommittees;
use App\Requests\Order\OrderRequest;
use App\Requests\Register\ClientRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function create($request, $service = null)
    {
        $orderRequest = new OrderRequest();
        $requestValidated = $orderRequest->validate($request);

        try {

            if($service == null) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Você precisa escolher um serviço para prosseguir !'
                ];
            }

            $requestValidated['service_id'] = $service['id'];

            $orderDB = auth()->user()->orders()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Seu pedido foi cadastrado com sucesso !'
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
            DB::beginTransaction();

            $orderDB = Orders::query()->findOrFail($id);
            $orderDB->update($requestValidated);


            DB::commit();
            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Seu pedido foi atualizado com sucesso !'
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
            $orderDB = Orders::query()->find($id);

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
            DB::beginTransaction();

            $orderDB = Orders::query()->findOrFail($id);
            $orderDB->delete();

            DB::commit();
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

            $orderDB = Orders::query()->with(['washer.committee', 'service'])->findOrFail($id);

            if($orderDB['status'] === 'accepted' && Auth::id() === $orderDB['washer_id']['user_id']) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Você já aceitou esse pedido !'
                ];
            }

            if($status === 'accepted') {
                $orderDB->update([
                    'status_washer' => $status,
                    'status' => $status,
                ]);

                $value_comission = $orderDB['service']['price'] * ($orderDB['washer']['committee']['value'] / 100);

                UserCommittees::query()->create([
                    'user_id' => $orderDB['washer_id'],
                    'order_id' => $orderDB['id'],
                    'value'=> $orderDB['service']['price'],
                    'percentage'=>  $orderDB['washer']['committee']['value'],
                    'value_commission' => $value_comission,
                ]);
            }

            if($status === 'declined') {
                $orderDB->update([
                    'status_washer' => $status
                ]);

                $userCommiteDB = UserCommittees::query()->where('order_id', $orderDB['id'])->first();

                if($userCommiteDB) {
                    $userCommiteDB->delete();
                }
            }

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
                'message' => 'Erro na requisição'
            ];
        }
    }


}

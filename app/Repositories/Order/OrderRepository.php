<?php

namespace App\Repositories\Order;

use App\Models\Orders;
use App\Models\OrdersStatus;
use App\Models\User;
use App\Models\UserCommittees;
use App\Repositories\Vendor\OrderStatusRepository;
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
            $orderDB = Orders::query()
                ->with([
                    'service.type',
                    'vehicle'
                ]);

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
            $orderDB = Orders::query()->where('id', $id)->first();

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,

            ];
        } catch (Exception $exception){
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
            DB::rollback();
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function updateStatus($id, $user_id, $status)
    {
        try {

            $orderDB = Orders::query()->with(['washer.committee', 'service'])->withoutGlobalScope('scope')->findOrFail($id);

            if($orderDB['washer_id'] != null && $orderDB['status_washer'] == 'accepted') {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Pedido já aceito por um profissional !'
                ];
            }

            $washerDB = User::query()->with(['committee'])->find($user_id);

            if($status === 'accepted') {

                $orderStatusRepository = new OrderStatusRepository();
                $orderStatusRepository->updateOrderStatuses($orderDB['id'], $orderDB['status'], $status);

                $orderDB->update([
                    'washer_id' => $washerDB['id'],
                    'status_washer' => $status,
                    'status' => $status,
                ]);

                $value_comission = $orderDB['service']['price'] * ($washerDB['committee']['value'] / 100);

                UserCommittees::query()->create([
                    'user_id' => $washerDB['id'],
                    'order_id' => $orderDB['id'],
                    'value'=> $orderDB['service']['price'],
                    'percentage'=>  $washerDB['committee']['value'],
                    'value_commission' => $value_comission,
                ]);
            }

            if($status === 'declined') {

                $orderStatusRepository = new OrderStatusRepository();
                $orderStatusRepository->resetOrderStatuses($orderDB['id']);

                $orderDB->update([
                    'status_washer' => $status,
                    'status' => 'received'
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

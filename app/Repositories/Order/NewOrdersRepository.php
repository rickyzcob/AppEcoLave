<?php

namespace App\Repositories\Order;

use App\Models\Orders;
use App\Models\User;
use App\Models\UserCommittees;
use App\Repositories\Vendor\OrderStatusRepository;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;

class NewOrdersRepository
{
    public function index($orderBy = null, $pageSize = null, $filterData = null)
    {
        try {
            $orderDB = Orders::query()
                ->with(['service.type', 'vehicle'])
                ->withoutGlobalScope('scope');

            $orderDB->whereIn('status_washer', ['waiting', 'declined']);

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

    public function updateStatus($id, $status, $washer_id)
    {

        try {

            $orderDB = Orders::query()
                ->with(['washer.committee', 'service'])
                ->withoutGlobalScope('scope')
                ->findOrFail($id);

            $washerDB = User::query()->with(['committee'])->findOrFail($washer_id);

            if($status === 'accepted') {

                $orderStatusRepository = new OrderStatusRepository();
                $orderStatusRepository->updateOrderStatuses($orderDB['id'], $orderDB['status'], $status);

                $orderDB->update([
                    'status_washer' => $status,
                    'status' => $status,
                    'washer_id' => $washerDB['id']
                ]);

                $percentage = $washerDB['committee']['value'];

                $value_comission = $orderDB['service']['price'] * ($percentage / 100);

                UserCommittees::query()->create([
                    'user_id' => $washerDB['id'],
                    'order_id' => $orderDB['id'],
                    'value' => $orderDB['service']['price'],
                    'percentage' => $percentage,
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

            if($status === 'canceled') {
                $userCommiteDB = UserCommittees::query()->where('order_id', $orderDB['id'])->first();

                if($userCommiteDB) {
                    $userCommiteDB->update(['status' => $status]);
                }
            }

            DB::commit();

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Status do pedido atualizado com sucesso !'
            ];


        } catch (\Exception $exception) {

            DB::rollBack();

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }
}

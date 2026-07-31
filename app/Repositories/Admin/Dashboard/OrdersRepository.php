<?php

namespace App\Repositories\Admin\Dashboard;

use App\Models\Orders;
use PHPUnit\Exception;

class OrdersRepository
{
    public function index($orderBy = null, $pageSize = null, $filterData = null)
    {
        try {
            $orderDB = Orders::query()
                ->with([
                    'service.type',
                    'statuses'
                ])->latest()->take(4);

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

}

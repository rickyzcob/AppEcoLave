<?php

namespace App\Repositories\Evaluate;

use App\Models\Orders;
use PHPUnit\Exception;

class EvaluateRepository
{

    public function index($orderBy = null)
    {
        try {
            $orderDB = Orders::query()->with(['user','service.type'])->whereNotNull('rate');

            if($orderBy) {
                $orderDB->orderBy($orderBy['column'], $orderBy['direction']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $orderDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if (isset($filterData['type']) && $filterData['type'] != null ) {
                $orderDB->where('type', $filterData['type']);
            }

            $orderDB = $orderDB->take(4)->get();

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

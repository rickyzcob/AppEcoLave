<?php

namespace App\Repositories\Washer\Financial;

use App\Models\Committees;
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

}

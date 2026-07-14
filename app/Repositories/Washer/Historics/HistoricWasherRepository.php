<?php

namespace App\Repositories\Washer\Historics;

use App\Models\UserCommittees;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class HistoricWasherRepository
{
    public function index($orderBy = null, $pageSize = null, $filterData = null)
    {
        try {
            $userCommitteess = UserCommittees::query()->with(['order.service.type']);

            $userCommitteess->where('user_id', Auth::id());

            if($orderBy) {
                $userCommitteess->orderBy($orderBy['column'], $orderBy['direction']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $userCommitteess->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if (isset($filterData['type']) && $filterData['type'] != null ) {
                $userCommitteess->where('type', $filterData['type']);
            }

            if($pageSize) {
                $userCommitteess = $userCommitteess->simplePaginate($pageSize);
            } else {
                $userCommitteess = $userCommitteess->get();
            }

            return [
                'status' => 'success',
                'data' => $userCommitteess,
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

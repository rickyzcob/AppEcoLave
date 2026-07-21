<?php

namespace App\Repositories\Evaluate;

use App\Models\Orders;
use App\Models\UsersReviews;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class EvaluateRepository
{

    public function index($orderBy = null)
    {
        try {
            $userReviewDB = UsersReviews::query()->with(['order.user']);

            $userReviewDB->where('washer_id', Auth::id());

//            $orderDB = Orders::query()->with(['user','service.type'])->whereNotNull('rate');

            if($orderBy) {
                $userReviewDB->orderBy($orderBy['column'], $orderBy['direction']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $userReviewDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if (isset($filterData['type']) && $filterData['type'] != null ) {
                $userReviewDB->where('type', $filterData['type']);
            }

            $userReviewDB = $userReviewDB->take(4)->get();

            return [
                'status' => 'success',
                'data' => $userReviewDB,
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

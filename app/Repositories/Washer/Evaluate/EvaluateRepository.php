<?php

namespace App\Repositories\Washer\Evaluate;

use App\Models\Orders;
use App\Models\User;
use App\Models\UsersReviews;
use App\Requests\Admin\OrderRequest;
use Illuminate\Support\Facades\Auth;

class EvaluateRepository
{

    public function evaluate($request, $quantity)
    {
        $orderRequest = new OrderRequest();
        $requesValidated = $orderRequest->validateEvaluateClient($request);

        try {

            $userReviewDB = UsersReviews::query()->create([
                'owner_id' => Auth::id(),
                'client_id' => $requesValidated['client_id'],
                'comment' => $requesValidated['comment'],
                'rate' => $quantity,
                'type' => 'washer',
            ]);


            return [
                'status' => 'success',
                'data' => $userReviewDB,
                'code' => 200,
                'message' => 'Avaliação do cliente cadastrada com sucesso !'
            ];

        } catch (\Exception $exception) {

            dd($exception);
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao atualizar status'
            ];
        }
    }

    public function getSelectClientByWasher()
    {
        $orderDB = Orders::query()
            ->where('washer_id', Auth::id())
            ->pluck('user_id')
            ->toArray();

        $usersReview = UsersReviews::query()
            ->where('owner_id', Auth::id())
            ->whereType('washer')
            ->pluck('client_id')
            ->toArray();

        $clientsDB = User::query()
            ->whereIn('id', $orderDB)
            ->whereNotIn('id', $usersReview)
            ->get();

        return $clientsDB;
    }
}

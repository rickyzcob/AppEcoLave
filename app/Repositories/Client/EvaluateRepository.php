<?php

namespace App\Repositories\Client;

use App\Models\Orders;
use App\Models\UsersReviews;
use App\Requests\Admin\OrderRequest;
use App\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class EvaluateRepository
{
    public function index($user_id)
    {
        try {

            $orderDB = Orders::query()->with(['review'])
                ->where('user_id', $user_id)
                ->where('status' , 'service_finish')
                ->doesntHave('review')
                ->orderBy('date_schedule' , 'ASC')
                ->first();

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
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

    public function evaluate($id, $request, $quantity)
    {
        $orderRequest = new OrderRequest();
        $requesValidated = $orderRequest->validateEvaluate($request);

        try {

            $orderDB = Orders::query()->with(['review'])->findOrFail($id);

            $userReviewDB = UsersReviews::query()->create([
                'owner_id' => Auth::id(),
                'washer_id' => $orderDB['washer_id'],
                'order_id' => $orderDB['id'],
                'comment' => $requesValidated['comment'],
                'rate' => $quantity,
                'type' => 'client',
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

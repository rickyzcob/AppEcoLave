<?php

namespace App\Repositories\Client;

use App\Models\Orders;
use App\Models\OrdersStatus;
use App\Models\User;
use App\Repositories\Vendor\OrderStatusRepository;
use App\Requests\Admin\OrderRequest;
use App\Requests\Client\NewScheduleRequest;
use App\Services\Asaas\ClientService;
use App\Services\Asaas\PaymentCreditCardService;
use App\Services\Asaas\PaymentPixService;
use PHPUnit\Exception;

class NewScheduleRepository
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

    public function create($client_id, $request)
    {
        $newScheduleRequest = new NewScheduleRequest();
        $requestValidated = $newScheduleRequest->validate($request);

        try {

            if($client_id) {
                $requestValidated['user_id'] = $client_id;
            } else {
                $userDB = User::query()->withoutGlobalScope('scope')->firstOrCreate(
                    [
                        'taxpayer_registration' => $requestValidated['user']['taxpayer_registration'],
                    ],
                    [
                        'name' => $requestValidated['user']['name'],
                        'email' => $requestValidated['user']['email'],
                        'phone' => $requestValidated['user']['phone'],
                        'taxpayer_registration' => $requestValidated['user']['taxpayer_registration']
                    ]
                );
                $requestValidated['user_id'] = $userDB['id'];
            }

            if($requestValidated['type_payment'] === 'online'){
                $requestValidated['status'] = 'waiting';
            }

            $orderDB = Orders::query()->create($requestValidated);


            $orderStatusRepository = new OrderStatusRepository();
            $orderStatusRepository->createStatusesByOrderId($orderDB->id);

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'O pedido foi cadastrado com sucesso !'
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
        $newScheduleRequest = new OrderRequest();
        $requestValidated = $newScheduleRequest->validate($request, $id);

        try {

            $orderDB = Orders::query()->findOrFail($id);
            $orderDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Seu pedido foi atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {

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
            $orderDB = Orders::query()->with(['user', 'service'])->find($id);

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

    public function showByReference($reference, $user_id)
    {
        try {
            $orderDB = Orders::query()
                ->with(['service.type', 'vehicle'])
                ->where('reference', $reference)
                ->where('user_id', $user_id)
//                ->where('status', 'waiting')
                ->first();

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

            $orderDB = Orders::query()->findOrFail($id);
            $orderDB->delete();

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

    public function addCreditCardPayment($order_id, $request)
    {
        $newScheduleRequest = new OrderRequest();
        $requestValidated = $newScheduleRequest->validatePayment($request);

        try {

            $orderDB = Orders::query()->with(['user', 'service'])->findOrFail($order_id);

            if($orderDB['status'] === 'waiting'){

                $this->addClientToAsaas($orderDB['user_id']);

                $paymentService = new PaymentCreditCardService();
                $paymentReturn = $paymentService->create($orderDB, $requestValidated);

                if(isset($paymentReturn['errors'])){
                    return [
                        'status' => 'error',
                        'code' => 400,
                        'data' => $paymentReturn['errors'][0],
                        'message' => 'Erro ao processar pagamento'
                    ];
                }

                $orderDB->update([
                    'status' => 'received',
                    'payment_id' => $paymentReturn['id'],
                ]);

                return [
                    'status' => 'success',
                    'data' => $orderDB,
                    'code' => 200,
                    'message' => 'Pagamento processado com sucesso !'
                ];
            }


        } catch (\Exception $exception) {

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao processar pagamento'
            ];
        }
    }

    public function addPixPayment($order_id)
    {
        try {

            $orderDB = Orders::query()->with(['user', 'service'])->findOrFail($order_id);

            if($orderDB['status'] === 'waiting' && $orderDB['payment_id'] === null){

                $return = $this->addClientToAsaas($orderDB['user_id']);

                if(isset($return['errors'])){
                    return [
                        'status' => 'error',
                        'code' => 400,
                        'message' => $return['errors'][0]['description']
                    ];
                }

                $paymentPixService = new PaymentPixService();
                $paymentReturn = $paymentPixService->create($orderDB);

                if(isset($paymentReturn['errors'])){
                    return [
                        'status' => 'error',
                        'code' => 400,
                        'data' => $paymentReturn['errors'][0],
                        'message' => 'Erro ao processar pagamento'
                    ];
                }

                $orderDB->update([
                    'payment_id' => $paymentReturn['id'],
                ]);
            }

            return [
                'status' => 'success',
                'data' => $orderDB,
                'code' => 200,
                'message' => 'Pix processado com sucesso !'
            ];

        } catch (\Exception $exception) {

            dd($exception);
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao processar pagamento'
            ];
        }
    }

    public function addClientToAsaas($user_id)
    {
        $userDB = User::query()->findOrFail($user_id);

        if($userDB['asaas_id'] === null) {
            $clientService = new ClientService();
            $clientReturn = $clientService->create($userDB);

            if(!isset($clientReturn['errors'])){
                $userDB->update([
                    'asaas_id' => $clientReturn['id'],
                ]);
            }
            return $clientReturn;

        }

        return '';


    }

}

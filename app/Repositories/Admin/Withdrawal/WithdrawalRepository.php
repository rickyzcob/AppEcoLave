<?php

namespace App\Repositories\Admin\Withdrawal;

use App\Models\User;
use App\Models\Withdrawals;
use App\Requests\Admin\WithDrawalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class WithdrawalRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $withDrawalDB = Withdrawals::query()->with(['user']);

            if($orderBy) {
                $withDrawalDB->orderBy($orderBy['column'], $orderBy['order']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $withDrawalDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if($pageSize) {
                $withDrawalDB = $withDrawalDB->paginate($pageSize);
            } else {
                $withDrawalDB = $withDrawalDB->get();
            }

            return [
                'status' => 'success',
                'data' => $withDrawalDB,
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

    public function create($request)
    {
        $withDrawalRequest = new WithDrawalRequest();
        $requestValidated = $withDrawalRequest->validate($request);


        try {
            $userDB = User::query()->findOrFail(Auth::id());

            if($requestValidated['amount'] > $userDB['value_commission']) {
                return [
                    'status' => 'error_balance',
                    'code' => 422,
                    'message' => 'Valor Solicitado é maio do que o saldo disponível !'
                ];
            }

            $withDrawalDB = auth()->user()->withdrawals()->create($requestValidated);

            $userDB->decrement('value_commission', $withDrawalDB['amount']);

            return [
                'status' => 'success',
                'data' => $withDrawalDB,
                'code' => 200,
                'message' => 'Solicitação cadastrada com sucesso !'
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
        $withDrawalRequest = new WithDrawalRequest();
        $requestValidated = $withDrawalRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $withDrawalDB = Withdrawals::query()->findOrFail($id);

            $userDB = User::query()->findOrFail(Auth::id());

            if($requestValidated['amount'] > $userDB['value_commission']) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Valor Solicitado é maio do que o saldo disponível !'
                ];
            }
            $withDrawalDB->update($requestValidated);



            DB::commit();

            return [
                'status' => 'success',
                'data' => $withDrawalDB,
                'code' => 200,
                'message' => 'Solicitação atualizada com sucesso !'
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
            $withDrawalDB = Withdrawals::query()->find($id);

            return [
                'status' => 'success',
                'data' => $withDrawalDB,
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
            DB::beginTransaction();

            $withDrawalDB = Withdrawals::query()->findOrFail($id);

            $userDB = User::query()->findOrFail(Auth::id());

            $userDB->increment('value_commission', $withDrawalDB['amount']);

            $withDrawalDB->delete();

            DB::commit();

            return [
                'status' => 'success',
                'data' => $withDrawalDB,
                'code' => 200,
                'message' => 'Solicitação deletada com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function updateStatus($id, $request, $file)
    {
        $withDrawalRequest = new WithDrawalRequest();
        $requestValidated = $withDrawalRequest->validateStatus($request, $id);

        try {
            DB::beginTransaction();

            $withDrawalDB = Withdrawals::query()->findOrFail($id);

            if($withDrawalDB['file_path'] != null && Storage::disk('public')->exists($withDrawalDB['file_path'])) {
                Storage::disk('public')->delete($withDrawalDB['file_path']);
            }
            $requestValidated['file_path'] = $file->store('proof', 'public');

            $withDrawalDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $withDrawalDB,
                'code' => 200,
                'message' => 'Solicitação atualizada com sucesso !'
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

}

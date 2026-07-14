<?php

namespace App\Repositories\Washer\Profile;

use App\Models\User;
use App\Requests\Washer\WasherRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ProfileRepository
{
    public function update($id, $request)
    {

        $washerRequest = new WasherRequest();
        $requestValidated = $washerRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $washerDB = User::query()->findOrFail($id);
            $washerDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $washerDB,
                'code' => 200,
                'message' => 'Profissional atualizado com sucesso !'
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
            $washerDB = User::query()->find($id);

            return [
                'status' => 'success',
                'data' => $washerDB,
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
}

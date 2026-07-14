<?php

namespace App\Repositories\Admin\Profile;

use App\Models\User;
use App\Requests\Admin\AdminRequest;
use App\Requests\Admin\ClientRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ProfileRepository
{
    public function update($id, $request)
    {
        $profileRequest = new AdminRequest();
        $requestValidated = $profileRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $usersDB = User::query()->findOrFail($id);
            $usersDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $usersDB,
                'code' => 200,
                'message' => 'Perfil atualizado com sucesso !'
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
            $usersDB = User::query()->find($id);

            return [
                'status' => 'success',
                'data' => $usersDB,
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

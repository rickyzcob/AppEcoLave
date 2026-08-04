<?php

namespace App\Repositories\Client;

use App\Models\User;
use App\Requests\Client\ClientRequest;
use App\Requests\PasswordRequest;
use App\Requests\Washer\WasherRequest;
use App\Services\Asaas\ClientService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class ProfileRepository
{

    public function update($id, $request, $image)
    {

        $clientRequest = new ClientRequest();
        $requestValidated = $clientRequest->validate($request, $id);

        try {
            DB::beginTransaction();

            $userDB = User::query()->findOrFail($id);

            if(isset($image) && $image != $userDB['profile_photo_path']){
                if(Storage::exists('public/'.$userDB['profile_photo_path'])) {
                    Storage::delete('public/'.$userDB['profile_photo_path']);
                }
                $requestValidated['profile_photo_path'] = $image->store('users/image', 'public');
            } else {
                $requestValidated['profile_photo_path'] = $userDB['profile_photo_path'];
            }

            $clientService = new ClientService();

            if($userDB['asaas_id'] === null) {
                $clientReturn = $clientService->create($requestValidated);
            } else {
                $clientReturn = $clientService->update($userDB['asaas_id'], $requestValidated);
            }

            if(isset($clientReturn['errors'])) {
                return [
                    'status' => 'error',
                    'data' => $userDB,
                    'code' => 400,
                    'message' => $clientReturn['errors'][0]['description']
                ];
            }
            $requestValidated['asaas_id'] = $clientReturn['id'];
            $userDB->update($requestValidated);


            DB::commit();

            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 200,
                'message' => 'Usuário atualizado com sucesso !'
            ];

        } catch (\Exception $exception) {

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

    public function updatePassword($request)
    {
        $clientRequest = new ClientRequest();
        $requestValidated = $clientRequest->validatePassword($request);

        try {
            $userDB = User::query()->findOrFail(Auth::user()->id);

            $userDB->update($requestValidated);
            $userDB->fresh();

            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 200,
                'message' => 'Senha atualizada com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }
}

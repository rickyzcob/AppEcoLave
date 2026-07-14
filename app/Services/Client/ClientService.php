<?php

namespace App\Services\Client;

use App\Models\User;

class ClientService
{
    public function getClient($taxpayer_registration)
    {
        $taxpayer_registration = dataCPFCNPJ($taxpayer_registration);

        $userDB = User::query()->where('taxpayer_registration', $taxpayer_registration)->first();

        if ($userDB) {
            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 200,
                'message' => 'Cliente Localizad com sucesso !'
            ];
        } else {
            return [
                'status' => 'error',
                'code' => 404,
                'message' => 'Cliente nao localizado'
            ];
        }


    }

}

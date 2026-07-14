<?php

namespace App\Requests\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class ClientRequest
{
    public function validate($request, $id = null)
    {
        $request['phone'] = dataCPFCNPJ($request['phone']);
        $request['taxpayer_registration'] = dataCPFCNPJ($request['taxpayer_registration']);

        $validator =  Validator::validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'taxpayer_registration' => [
                'required',
                "unique :users,taxpayer_registration,{$id},id"
            ],
            'email' => [
                'required',
                "unique :users,email,{$id},id"
            ]
        ]);

        return $validator;

    }
}

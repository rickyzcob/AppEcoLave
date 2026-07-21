<?php

namespace App\Requests\Client;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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
            ],
//            'password' => [
//                Rule::requiredIf(fn () => $id == null),
//                'confirmed',
//                Rules\Password::defaults(),
//            ],
//            'password_confirmation' => [
//                Rule::requiredIf(fn () => $id == null),
//                'nullable',
//            ],
            'zip_code' => 'required',
            'address' => 'required',
            'number' => 'required',
            'complement' => 'sometimes|nullable',
            'neighborhood' => 'required',
            'city' => 'required',
            'uf' => 'required',

        ]);

        return $validator;

    }

    public function validatePassword($request)
    {
        $validator =  Validator::validate($request, [

            'current_password' => ['required', 'current_password'],

            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed',
            ],
        ]);

        return $validator;
    }
}

<?php

namespace App\Requests\Register;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class ClientRequest
{
    public function validate($request, $id = null)
    {
        $request['phone'] = dataCPFCNPJ($request['phone']);

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
            'password' => [
                Rule::requiredIf(fn () => $id == null),
                'confirmed',
                Rules\Password::defaults(),
            ],
            'password_confirmation' => [
                Rule::requiredIf(fn () => $id == null),
                'nullable',
            ],
        ]);
        return $validator;
    }
}

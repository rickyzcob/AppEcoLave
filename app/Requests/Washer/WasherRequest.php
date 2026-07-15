<?php

namespace App\Requests\Washer;

use Illuminate\Support\Facades\Validator;

class WasherRequest
{
    public function validate($request, $id = null)
    {
        $request['phone'] = dataCPFCNPJ($request['phone']);

        $validator =  Validator::validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'committee_id' => 'required',
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
            'is_online' => 'sometimes|nullable',
            'bank_name' => 'required',
            'key_pix' => 'required',
        ]);

        return $validator;

    }

}

<?php

namespace App\Requests\Admin;

use Illuminate\Support\Facades\Validator;

class OrderRequest
{
    public function validate($request, $id = null)
    {

        $request['user']['phone'] = dataCPFCNPJ($request['user']['phone']);
        $request['user']['taxpayer_registration'] = dataCPFCNPJ($request['user']['taxpayer_registration']);

        $validator =  Validator::validate($request, [
            'user.name' => 'required',
            'user.phone' => 'required',
            'user.email' => 'required',
            'user.taxpayer_registration' => 'required',
            'type_id' => 'required',
            'service_id' => 'required',
            'vehicle_id' => 'required',
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'complement' => 'sometimes|nullable',
            'neighborhood' => 'sometimes|nullable',
            'city' => 'sometimes|nullable',
            'uf' => 'sometimes|nullable',
            'date_schedule' => 'required',
            'hour_schedule' => 'required'
        ]);
        return $validator;
    }

    public function validateEvaluate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'comment' => 'sometimes|nullable'
        ]);
        return $validator;
    }

    public function validateEvaluateClient($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'client_id' => 'required',
            'comment' => 'sometimes|nullable'
        ]);
        return $validator;
    }

    public function validatePayment($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'taxpayer_registration' => 'required',
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'complement' => 'sometimes|nullable',
            'neighborhood' => 'sometimes|nullable',
            'holder_name' => 'required',
            'holder_number' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'ccv' => 'required',
        ]);

        return $validator;
    }
}

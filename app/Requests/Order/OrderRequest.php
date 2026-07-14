<?php

namespace App\Requests\Order;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrderRequest
{
    public function validate($request, $id = null)
    {
        $request['phone'] = dataCPFCNPJ($request['phone']);

        $validator =  Validator::validate($request, [
            'phone' => 'required',
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'complement' => 'sometimes|nullable',
            'neighborhood' => 'sometimes|nullable',
            'city' => 'sometimes|nullable',
            'uf' => 'sometimes|nullable',
            'vehicle' => 'required',
            'vehicle_plate' => 'required'
        ]);
        return $validator;
    }
}

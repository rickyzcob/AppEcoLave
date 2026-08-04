<?php

namespace App\Requests\Client;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NewScheduleRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'vehicle_id' => 'required',
            'service_id' => 'required',
            'date_schedule' => 'required',
            'hour_schedule' => 'required',
            'observations' => 'sometimes|nullable',
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'complement' => 'sometimes|nullable',
            'neighborhood' => 'sometimes|nullable',
            'city' => 'sometimes|nullable',
            'uf' => 'sometimes|nullable',
            'type_payment' => 'required',
            'payment_method' => [
                Rule::requiredIf(fn () => $request['type_payment'] == 'online'),
                'sometimes',
            ]
        ]);
        return $validator;
    }

}

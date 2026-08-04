<?php

namespace App\Requests\Client;

use Illuminate\Support\Facades\Validator;

class VehicleRequest
{
    public function validate($request, $id = null)
    {
         $validator =  Validator::validate($request, [
            'type_vehicle_id' => 'required',
            'name' => 'required',
            'brand' => 'required',
            'plate' => 'required',
            'color' => 'required',
            'year' => 'sometimes|nullable',
        ]);

        return $validator;

    }
}

<?php

namespace App\Requests\Admin;

use Illuminate\Support\Facades\Validator;

class TypeVehicleRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        return $validator;
    }
}

<?php

namespace App\Requests\Admin;

use Illuminate\Support\Facades\Validator;

class ServiceRequest
{
    public function validate($request, $id = null)
    {
        $request['price'] = formatDecimal($request['price']);

        $validator =  Validator::validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        return $validator;
    }

}

<?php

namespace App\Requests\Admin;

use Illuminate\Support\Facades\Validator;

class ConfigurationsRequest
{
    public function validate($request, $id = null)
    {

        $validator =  Validator::validate($request, [
            'name' => 'required',
            'description' => 'sometimes|nullable',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        return $validator;
    }

}

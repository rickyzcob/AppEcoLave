<?php

namespace App\Requests\Admin;

use Illuminate\Support\Facades\Validator;

class CommitteesRequest
{
    public function validate($request, $id = null)
    {
        $request['value'] = formatDecimal($request['value']);

        $validator =  Validator::validate($request, [
            'name' => 'required',
            'value' => 'required',
        ]);

        return $validator;
    }

}

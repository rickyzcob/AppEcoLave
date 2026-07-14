<?php

namespace App\Requests\Admin;

use Illuminate\Support\Facades\Validator;

class WithDrawalRequest
{
    public function validate($request, $id = null)
    {
        $request['amount'] = formatDecimal($request['amount']);

        $validator =  Validator::validate($request, [
            'amount' => 'required',
            'key_pix' => 'required',
        ]);

        return $validator;
    }

    public function validateStatus($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'proof_number' => 'required',
            'status' => 'required',
            'observations' => 'sometimes|nullable',
        ]);

        return $validator;
    }

}

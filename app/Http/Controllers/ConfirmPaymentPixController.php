<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class ConfirmPaymentPixController extends Controller
{
    public function confirm(Request $request)
    {
        if($request['event'] == 'PAYMENT_RECEIVED' || $request['event'] == 'PAYMENT_CONFIRMED') {

            $orderDB = Orders::query()->where('payment_id', $request['payment']['id'])->withoutGlobalScope('scope')->first();
            $orderDB->update(['status' => 'received']);

        }
    }
}

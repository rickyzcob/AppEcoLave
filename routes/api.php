<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmPaymentPixController;


Route::post('update-payment', [ConfirmPaymentPixController::class, 'confirm']);


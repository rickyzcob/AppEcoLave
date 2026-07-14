<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'washer'])->group(function () {
    Route::view('/dashboard', 'washer.dashboard.index')->middleware('auth')->name('dashboard');
    Route::view('/pedidos', 'washer.orders.index')->middleware('auth')->name('orders');
    Route::view('/avaliacoes', 'washer.evaluate.index')->middleware('auth')->name('evaluate');
    Route::view('/financeiro', 'washer.financial.index')->middleware('auth')->name('financial');
    Route::view('/historico', 'washer.historic.index')->middleware('auth')->name('historic');
    Route::view('/meu-perfil', 'washer.profile.index')->middleware('auth')->name('profile');
});

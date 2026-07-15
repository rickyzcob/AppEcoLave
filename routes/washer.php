<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'washer'])->group(function () {
    Route::view('/dashboard', 'washer.dashboard.index')->name('dashboard');
    Route::view('/meus-pedidos', 'washer.my-orders.index')->name('my-my-orders');
    Route::view('/novos-pedidos', 'washer.new-orders.index')->name('new_orders');
    Route::view('/avaliacoes', 'washer.evaluate.index')->name('evaluate');
    Route::view('/financeiro', 'washer.financial.index')->name('financial');
    Route::view('/historico', 'washer.historic.index')->name('historic');
    Route::view('/meu-perfil', 'washer.my-profile.index')->name('my-profile');
});

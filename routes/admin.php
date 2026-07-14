<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/dashboard', 'admin.dashboard.index')->middleware('auth')->name('dashboard');
    Route::view('/clientes', 'admin.clients.index')->middleware('auth')->name('clients');
    Route::view('/profissionais', 'admin.washers.index')->middleware('auth')->name('washers');
    Route::view('/comissoes', 'admin.committees.index')->middleware('auth')->name('committees');
    Route::view('/servicos', 'admin.services.index')->middleware('auth')->name('services');
    Route::view('/pedidos', 'admin.orders.index')->middleware('auth')->name('orders');
    Route::view('/usuarios', 'admin.users.index')->middleware('auth')->name('users');
    Route::view('/avaliacoes', 'admin.evaluate.index')->middleware('auth')->name('evaluate');
    Route::view('/financeiro', 'admin.financial.index')->middleware('auth')->name('financial');
    Route::view('/solicitacoes-de-saques', 'admin.withdrawal.index')->middleware('auth')->name('withdrawal');

    Route::view('/meu-perfil', 'admin.profile.index')->middleware('auth')->name('profile');

});


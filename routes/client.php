<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'client'])->group(function () {
    Route::view('/dashboard', 'client.dashboard.index')->name('dashboard');
    Route::view('/novo-agendamento', 'client.new-schedule.index')->name('new-schedule');
    Route::view('/meus-agendamentos', 'client.my-schedules.index')->name('my-schedule');
    Route::view('/avaliacoes', 'client.evaluate.index')->name('evaluates');
    Route::view('/meus-veiculos', 'client.vehicles.index')->name('vehicles');
    Route::view('/carteira', 'client.wallet.index')->name('wallet');
    Route::view('/historico', 'client.historics.index')->name('historics');
//    Route::view('/financeiro', 'washer.financial.index')->name('financial');
//    Route::view('/historico', 'washer.historic.index')->name('historic');
    Route::view('/meu-perfil', 'client.my-profile.index')->name('my-profile');
    Route::view('/configuracoes', 'client.configurations.index')->name('configurations');
});

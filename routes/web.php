<?php

use Illuminate\Support\Facades\Route;

Route::view('/login', 'site.login.index')->name('login');
Route::view('/forgot-password', 'site.login.forgot-password')->name('password.request');
Route::view('/reset-password/{token}', 'site.login.reset-password')->name('password.reset');


Route::view('/', 'site.home.index')->name('home');
Route::view('/sobre', 'site.about.index')->name('about');

Route::view('/planos', 'site.plans.index')->name('plans');
Route::view('/depoimentos', 'site.testimonials.index')->name('testimonials');
Route::view('/contato', 'site.contact.index')->name('contact');

Route::view('/area-do-lavador', 'site.washer.index')->name('washer');

Route::middleware(['auth', 'client'])->group(function () {
    Route::view('/agendamentos', 'site.schedule.index')->name('schedule');
    Route::view('/meus-pedidos', 'site.orders.index')->name('orders');
    Route::view('/meu-perfil', 'site.profile.index')->name('profile');
});

Route::get('/auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'callback'])
    ->name('google.callback');


Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');


require __DIR__.'/auth.php';

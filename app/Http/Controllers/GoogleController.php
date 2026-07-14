<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function callback()
    {
        $google = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            [
                'email' => $google->getEmail(),
            ],
            [
                'name'      => $google->getName(),
                'google_id' => $google->getId(),
                'avatar'    => $google->getAvatar(),
            ]
        );

        Auth::login($user, true);

        return redirect()->route('home');
    }
}

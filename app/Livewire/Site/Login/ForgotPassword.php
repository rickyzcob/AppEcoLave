<?php

namespace App\Livewire\Site\Login;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));



//        return redirect()->route('client')->with($clientReturnDB['status'], $clientReturnDB['message']);


        session()->flash('success', 'Um link para redefinição de senha será enviado caso a conta exista.');
//
        $this->redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.site.login.forgot-password');
    }
}

<?php

namespace App\Livewire\Site\Login;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Socialite;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Form extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password, 'status' => 'active'], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        if(auth()->user()->scope === 'admin'){
            $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: false);
        }

        if(auth()->user()->scope === 'washer'){
            $this->redirectIntended(default: route('professional.dashboard', absolute: false), navigate: false);
        }

        if(auth()->user()->scope === 'client'){
            $this->redirectIntended(default: route('home', absolute: false), navigate: false);
        }

    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }

    public function loginGoogle()
    {
        return $this->redirect(
            Socialite::driver('google')->redirect()->getTargetUrl(),
            navigate: false
        );
    }

    public function render()
    {
        return view('livewire.site.login.form');
    }
}

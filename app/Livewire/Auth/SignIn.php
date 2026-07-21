<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.auth')]
class SignIn extends Component
{
    public string $credential = '';
    public string $password = '';
    public bool $remember = false;

    public function authenticate(): void
    {
        $this->validate(
            rules: [
                'credential' => ['required'],
                'password'   => ['required'],
            ],
            messages: [
                'credential.required' => 'Username or email is required.',
                'password.required'   => 'Password is required.',
            ]
        );

        $field = filter_var($this->credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (!Auth::attempt(
            [$field => $this->credential, 'password' => $this->password],
            $this->remember
        )) {
            $this->addError('credential', 'Email atau password salah.');
            return;
        }

        session()->regenerate();
        $this->redirect(route('index'));
    }

    public function render()
    {
        return view('livewire.auth.sign-in');
    }
}
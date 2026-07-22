<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Profile extends Component
{
    public $name;
    public $email;
    public $phone;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->phone = Auth::user()->phone;
    }

    public function savePersonalInfo()
    {
        $this->validate(
            rules: [
                'name' => ['required','max:255'],
                'email' => ['required','email', 'unique:users,email,' . Auth::id()],
                'phone' => ['unique:users,phone,' . Auth::id()],
            ],
            messages: [
                'name.required' => 'First name is required.',
                'name.max' => 'First name cannot exceed 255 characters.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already taken.',
                'phone.unique' => 'This phone number is already taken.',
            ]
        );

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->save();

        $this->dispatch('notify', 
            type: 'success',
            title: 'Success',
            message: 'Profile updated successfully.'
        );
    }

    public function render()
    {
        return view('livewire.dashboard.profile')
            ->title("User Profile");
    }
}

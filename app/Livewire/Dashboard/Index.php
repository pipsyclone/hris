<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.index')
            ->title("Welcome to Dashboard");
    }
}

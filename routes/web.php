<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Livewire\Auth\SignIn;

// Pages
use App\Livewire\Dashboard\Index;
use App\Livewire\Dashboard\Profile;

Route::get('/', function () {
    return view('pages.welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::livewire('/signin', SignIn::class)->name('signin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/signout', function () {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('signin');
    })->name('signout');

    Route::livewire('/profile', Profile::class)->name('profile');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::livewire('/', Index::class)->name('index');
    });
});

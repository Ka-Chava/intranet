<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function() {
    $user = Socialite::driver('okta')->user();

    return Socialite::driver('okta')->redirect();
});
Route::get('okta/callback', function() {
    $user = Socialite::driver('okta')->user();
    dd($user);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

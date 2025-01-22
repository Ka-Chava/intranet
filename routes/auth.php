<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Livewire\Volt\Volt;

Route::get('/', function() {
    return Socialite::driver('okta')->redirect();
});
Route::get('okta/callback', function() {
    $oktaUser = Socialite::driver('okta')->user();

    //dd($oktaUser);

    $user = User::updateOrCreate([
        'okta_id' => $oktaUser->id,
    ], [
        'name' => $oktaUser->name,
        'email' => $oktaUser->email,
        'okta_token' => $oktaUser->token,
        'okta_refresh_token' => $oktaUser->refreshToken,
    ]);

    try {
        Auth::login($user);
    }
    catch (\Throwable $e) {
        return redirect('/okta');
    }

    return redirect('/dashboard');
});

/*
Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
*/

<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Volt\Volt;

Route::get('/', function() {
    return Socialite::driver('okta')->redirect();
});

Route::get('/dump', function() {
    dd(User::all());
});

Route::get('okta/callback', function() {
    $oktaUser = Socialite::driver('okta')->user();

    $user = User::updateOrCreate([
        'okta_id' => $oktaUser->id,
    ], [
        'okta_id' => $oktaUser->id,
        'name' => $oktaUser->name,
        'email' => $oktaUser->email,
        'okta_token' => $oktaUser->token,
        'okta_refresh_token' => $oktaUser->refreshToken,
    ]);

    //no password on that user, let's generate a blank one
    if(!$user->password) {
        $user->password = Str::password();
        $user->save();
    }

    try {
        Auth::login($user);
    }
    catch (\Throwable $e) {
        return redirect('/okta');
    }

    return redirect()->route('dashboard');
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

<?php

use Illuminate\Support\Facades\Route;

Route::view('/styleguide', 'styleguide')
    ->middleware(['auth', 'verified'])
    ->name('styleguide');

Route::view('/my', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('/my/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('/my/helpdesk/ticket', 'helpdesk/ticket')->middleware(['auth', 'verified'])->name('helpdesk.ticket');

Route::get('/my/policy/{slug}', function(string $slug) {
    $policy = \App\Models\Policy::where('slug', $slug)->first();
    return view('policy', ['policy' => $policy]);
});

require __DIR__.'/store.php';

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('helpdesk/ticket', 'helpdesk/ticket')->middleware(['auth', 'verified'])->name('helpdesk.ticket');


require __DIR__.'/employee-store.php';

require __DIR__.'/auth.php';

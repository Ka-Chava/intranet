<?php

use Illuminate\Support\Facades\Route;

Route::view('my', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('my/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('my/helpdesk/ticket', 'helpdesk/ticket')->middleware(['auth', 'verified'])->name('helpdesk.ticket');


require __DIR__.'/employee-store.php';

require __DIR__.'/auth.php';

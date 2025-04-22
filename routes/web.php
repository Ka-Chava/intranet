<?php

use Illuminate\Support\Facades\Route;

Route::view('/styleguide', 'styleguide')
    ->middleware(['auth', 'verified'])
    ->name('styleguide');

Route::view('/my/handbook', 'handbook')
    ->middleware(['auth', 'verified'])
    ->name('handbook');

Route::view('/my/helpdesk', 'helpdesk')
    ->middleware(['auth', 'verified'])
    ->name('helpdesk');

Route::view('/my/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('/my/helpdesk/ticket', 'helpdesk/ticket')->middleware(['auth', 'verified'])->name('helpdesk.ticket');

Route::get('/my/policy/{slug}', function(string $slug) {
    $policy = \App\Models\Policy::where('slug', $slug)->first();
    return view('policy', ['policy' => $policy]);
});

Route::get('/my', [\App\Http\Controllers\DashboardController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/my/blog/{slug}', function (string $slug) {
   return view('article', [
       'article' => \App\Models\BlogPost::where('slug', $slug)->first()
   ]);
});

require __DIR__.'/store.php';

require __DIR__.'/auth.php';

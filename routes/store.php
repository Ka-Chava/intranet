<?php

use Illuminate\Support\Facades\Route;


Route::view('my/store', 'store')
    ->middleware(['auth', 'verified'])
    ->name('store');

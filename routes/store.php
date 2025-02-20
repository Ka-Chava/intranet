<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;


Route::get('my/store', [StoreController::class, 'viewStore'])
    ->middleware(['auth', 'verified'])
    ->name('store');

<?php

use App\Http\Controllers\EmployeeStoreController;
use Illuminate\Support\Facades\Route;


Route::get('dashboard/store', [EmployeeStoreController::class, 'viewStore'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.employee.store');

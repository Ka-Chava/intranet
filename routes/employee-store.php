<?php

use Illuminate\Support\Facades\Route;
use KCA\Controllers\EmployeeStoreController;



Route::get('employee/store', [EmployeeStoreController::class, 'viewStore'])
    ->middleware(['auth', 'verified'])
    ->name('employee.store');

<?php

use App\Http\Controllers\EmployeeStoreController;
use Illuminate\Support\Facades\Route;


Route::get('my/employee-store', [EmployeeStoreController::class, 'viewStore'])
    ->middleware(['auth', 'verified'])
    ->name('employee.store');

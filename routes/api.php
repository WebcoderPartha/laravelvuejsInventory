<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AdminAuthController;
use App\Http\Controllers\Api\Employee\EmployeeController;

Route::prefix('auth')->controller(AdminAuthController::class)->group(function (){
    Route::post('/register', 'Register');
    Route::get('/me', 'getAuthUser');
    Route::post('/login', 'Login');
    Route::get('/logout', 'Logout');
    Route::get('/user/{id}', 'userbyId');
});

Route::middleware('jwtAuth')->apiResource('/employee', EmployeeController::class);
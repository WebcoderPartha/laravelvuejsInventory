<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AdminAuthController;
use App\Http\Controllers\Api\Employee\EmployeeController;
use App\Http\Controllers\Api\Supplier\SupplierController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Product\ProductController;

Route::prefix('auth')->controller(AdminAuthController::class)->group(function (){
    Route::post('/register', 'Register');
    Route::get('/me', 'getAuthUser');
    Route::post('/login', 'Login');
    Route::get('/logout', 'Logout');
    Route::get('/user/{id}', 'userbyId');
});

Route::middleware(['jwtAuth','throttle:500,1'])->group(function (){
    Route::apiResource('/employee', EmployeeController::class);
    Route::apiResource('/supplier', SupplierController::class);
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/product', ProductController::class);
});
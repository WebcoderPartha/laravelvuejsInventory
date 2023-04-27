<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AdminAuthController;
use App\Http\Controllers\Api\Employee\EmployeeController;
use App\Http\Controllers\Api\Supplier\SupplierController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\Salary\SalaryController;
use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\POS\PosController;
use App\Http\Controllers\Api\SettingController;


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
    Route::apiResource('/expense', ExpenseController::class);
    Route::apiResource('/salary', SalaryController::class);
    Route::apiResource('/customer', CustomerController::class);

    // Stock Update
    Route::post('/stock-update/{id}', [ProductController::class, 'updateStock']);

    // POS APIs
    Route::get('/catbyidproducts/{id}', [PosController::class, 'getCategoryIDbyProducts']);
    Route::get('/getallproduct', [PosController::class, 'AllProducts']);
    Route::post('/addtocart/{id}', [PosController::class, 'addToCart']);
    Route::get('/getcarts', [PosController::class, 'getCarts']);
    Route::delete('/remove_cart/{id}', [PosController::class, 'removeCart']);

    Route::post('/incqty/{id}', [PosController::class, 'incrementQty']);
    Route::post('/decqty/{id}', [PosController::class, 'descrementQty']);

    Route::apiResource('/setting',SettingController::class);


});
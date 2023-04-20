<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AdminAuthController;


Route::prefix('auth')->controller(AdminAuthController::class)->group(function (){
    Route::post('/register', 'Register');
});
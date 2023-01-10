<?php

use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\CarSell\CarSellController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\OtpVerificationController;
use App\Http\Controllers\User\Auth\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// user registration route
Route::controller(Register::class)->group(function () {
    Route::post('/users/register', 'register');
});
// user login route
Route::controller(LoginController::class)->group(function () {
    Route::post('/users/login', 'login');
});



Route::middleware('auth:sanctum')->group(function () {
    // user otp verification route
    Route::controller(OtpVerificationController::class)->group(function () {
        Route::post('/users/otp', 'verifyOtp');
    });

    // car sell route
    Route::controller(CarSellController::class)->group(function () {
        Route::post('/create/ads', 'create');
        Route::post('/create/drafts/{id}', 'drafts');
        Route::post('/create/select-package/{id}', 'select_package');
        Route::post('/create/vehicle-data/{id}', 'vehicle_data');
    });


    
    // car brand route
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brand', 'index');
    });
});

<?php

use App\Http\Controllers\API\V2\ForgotPasswordController;
use App\Http\Controllers\API\V2\HomeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\V2\AuthController;

Route::group(['prefix' => 'employee'], function () {

    Route::post('login', [AuthController::class, 'login']);

    Route::post('forgetpassword', [ForgotPasswordController::class, 'forgetpassword']);
    Route::post('activcode', [ForgotPasswordController::class, 'activcode']);
    Route::post('rechangepass', [ForgotPasswordController::class, 'rechangepass']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('home', [HomeController::class,'index']);

    });
});

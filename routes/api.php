<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HomeController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'store']);

Route::group(['middleware' => ['auth:sanctum', 'api']], function () {
    Route::get('home', [HomeController::class, 'home']);
});

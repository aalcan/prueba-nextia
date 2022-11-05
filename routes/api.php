<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BienesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);

Route::middleware('auth:sanctum')->post('/user', [UserController::class, 'create']);

Route::post('/login', [LoginController::class, 'logIn']);

Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logOut']);

Route::middleware('auth:sanctum')->controller(BienesController::class)->group(function () {
    Route::get('/bienes', 'getAll');
    Route::post('/bienes', 'create');
    Route::get('/bienes/list', 'getByList');
    Route::get('/bienes/{id}', 'getById');
    Route::put('/bienes/{id}', 'update');
    Route::delete('/bienes/{id}', 'destroy');
});
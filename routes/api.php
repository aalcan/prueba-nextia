<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);

Route::middleware('auth:sanctum')->post('/user', [UserController::class, 'create']);

Route::post('/login', [LoginController::class, 'logIn']);

Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logOut']);
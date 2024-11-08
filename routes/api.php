<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(['auth:sanctum', 'api']); 
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::post('/', [CustomerController::class, 'store']);
        Route::get('{id}', [CustomerController::class, 'show']);
        Route::post('{id}', [CustomerController::class, 'update']);
        Route::delete('{id}', [CustomerController::class, 'destroy']);
    });

    Route::prefix('departments')->group(function () {
        Route::get('/', [DepartmentController::class, 'index']);
        Route::post('/', [DepartmentController::class, 'store']);
        Route::get('{id}', [DepartmentController::class, 'show']);
        Route::post('{id}', [DepartmentController::class, 'update']);
        Route::delete('{id}', [DepartmentController::class, 'destroy']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']); 
        Route::post('/', [UserController::class, 'store']); 
        Route::get('{id}', [UserController::class, 'show']); 
        Route::post('{id}', [UserController::class, 'update']); 
        Route::delete('{id}', [UserController::class, 'destroy']); 
    });
    
});


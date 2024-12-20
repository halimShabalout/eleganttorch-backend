<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommunictionRequestController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisionController;


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
    Route::post('/admin-login', [AuthController::class, 'login'])->withoutMiddleware(['auth:sanctum', 'api']); 
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']); 
    Route::post('/', [UserController::class, 'store']); 
    Route::get('{id}', [UserController::class, 'show']); 
    Route::post('{id}', [UserController::class, 'update']); 
    Route::delete('{id}', [UserController::class, 'destroy']); 
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('about-us')->group(function () {
        Route::get('/', [AboutUsController::class, 'index']);
        Route::post('/', [AboutUsController::class, 'store']);
        Route::get('{id}', [AboutUsController::class, 'show']);
        Route::post('{id}', [AboutUsController::class, 'update']);
        Route::delete('{id}', [AboutUsController::class, 'destroy']);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('{id}', [CategoryController::class, 'show']);
        Route::post('{id}', [CategoryController::class, 'update']);
        Route::delete('{id}', [CategoryController::class, 'destroy']);
    });


    Route::prefix('Communiction-requests')->group(function () {
        Route::get('/', [CommunictionRequestController::class, 'index']);
        Route::post('/', [CommunictionRequestController::class, 'store']);
        Route::get('{id}', [CommunictionRequestController::class, 'show']);
        Route::post('{id}', [CommunictionRequestController::class, 'update']);
        Route::delete('{id}', [CommunictionRequestController::class, 'destroy']);
    });

    Route::prefix('contact-info')->group(function () {
        Route::get('/', [ContactInfoController::class, 'index']);
        Route::post('/', [ContactInfoController::class, 'store']);
        Route::get('{id}', [ContactInfoController::class, 'show']);
        Route::post('{id}', [ContactInfoController::class, 'update']);
        Route::delete('{id}', [ContactInfoController::class, 'destroy']);
    });

    
    Route::prefix('main')->group(function () {
        Route::get('/', [MainController::class, 'index']);
        Route::post('/', [MainController::class, 'store']);
        Route::get('{id}', [MainController::class, 'show']);
        Route::post('{id}', [MainController::class, 'update']);
        Route::delete('{id}', [MainController::class, 'destroy']);
    });


    Route::prefix('mission')->group(function () {
        Route::get('/', [MissionController::class, 'index']);
        Route::post('/', [MissionController::class, 'store']);
        Route::get('{id}', [MissionController::class, 'show']);
        Route::post('{id}', [MissionController::class, 'update']);
        Route::delete('{id}', [MissionController::class, 'destroy']);
    });


    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('{id}', [ProductController::class, 'show']);
        Route::post('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'destroy']);
    });


    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::post('/', [ProjectController::class, 'store']);
        Route::get('{id}', [ProjectController::class, 'show']);
        Route::post('{id}', [ProjectController::class, 'update']);
        Route::delete('{id}', [ProjectController::class, 'destroy']);
    });


    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index']);
        Route::post('/', [ServiceController::class, 'store']);
        Route::get('{id}', [ServiceController::class, 'show']);
        Route::post('{id}', [ServiceController::class, 'update']);
        Route::delete('{id}', [ServiceController::class, 'destroy']);
    });


    Route::prefix('vision')->group(function () {
        Route::get('/', [VisionController::class, 'index']);
        Route::post('/', [VisionController::class, 'store']);
        Route::get('{id}', [VisionController::class, 'show']);
        Route::post('{id}', [VisionController::class, 'update']);
        Route::delete('{id}', [VisionController::class, 'destroy']);
    });
});
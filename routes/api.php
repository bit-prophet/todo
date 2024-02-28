<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PusherAuthController;
use App\Http\Controllers\TodoController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('auth:sanctum')->group(function () {
    // To-do routes
    Route::apiResource('todos', TodoController::class)->except(['create', 'edit']);

    // Toggle completed route
    Route::patch('/todos/{todo}/toggle-completed', [TodoController::class, 'toggleCompleted']);

    // User route
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });
});

Route::post('/pusher/auth', [PusherAuthController::class, 'authenticate']);

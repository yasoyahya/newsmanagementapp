<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\AdminMiddleware;

// Route::apiResource('/news', NewsController::class)->middleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->group(function () {

    // News Controller
    Route::post('/news', [NewsController::class, 'store']);
    Route::patch('/news/{id}', [NewsController::class, 'update']);
    Route::delete('/news/{id}', [NewsController::class, 'destroy']);

    // Authentication Controller
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);

});

// News Controller
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);

// Authentication Controller
Route::post('/login', [AuthenticationController::class, 'login']);

   
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

// user register & user login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// display quotes, save quotes, delete quotes
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/quotes/random', [QuoteController::class, 'getRandom']);
    Route::post('/quotes', [QuoteController::class, 'store']);
    Route::get('/quotes', [QuoteController::class, 'index']);
    Route::delete('/quotes/{id}', [QuoteController::class, 'destroy']);
});

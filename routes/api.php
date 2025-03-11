<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'auth.role:client'])->group(function(){
    Route::get('/test', function(){
        return response()->json('hi client');
    });
});

Route::get('/category/list', [CategoryController::class, 'index']);
Route::post('/category/create', [CategoryController::class, 'store']);
Route::prefix('category')->middleware(['auth:sanctum', 'auth.role:admin'])->group(function(){
});
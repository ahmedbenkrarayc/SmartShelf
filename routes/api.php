<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RayonController;

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

Route::get('/rayon/list', [RayonController::class, 'index']);
Route::post('/rayon/create', [RayonController::class, 'store']);
Route::put('/rayon/update/{id}', [RayonController::class, 'update']);
Route::get('/rayon/{id}', [RayonController::class, 'show']);
Route::delete('/rayon/{id}', [RayonController::class, 'destroy']);

Route::prefix('category')->middleware(['auth:sanctum', 'auth.role:admin'])->group(function(){
    Route::get('/list', [CategoryController::class, 'index']);
    Route::post('/create', [CategoryController::class, 'store']);
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});
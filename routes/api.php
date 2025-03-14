<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RayonController;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('category')->middleware(['auth:sanctum', 'auth.role:admin'])->group(function(){
    Route::get('/list', [CategoryController::class, 'index']);
    Route::post('/create', [CategoryController::class, 'store']);
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

Route::prefix('rayon')->middleware(['auth:sanctum', 'auth.role:admin'])->group(function(){
    Route::get('/list', [RayonController::class, 'index']);
    Route::post('/create', [RayonController::class, 'store']);
    Route::put('/update/{id}', [RayonController::class, 'update']);
    Route::get('/{id}', [RayonController::class, 'show']);
    Route::delete('/{id}', [RayonController::class, 'destroy']);
});

Route::prefix('produit')->middleware(['auth:sanctum', 'auth.role:client'])->group(function(){
    Route::get('/rayon/{rayon}', [ProduitController::class, 'productByRayon']);
    Route::get('/search/{keyword}', [ProduitController::class, 'productByKeyword']);
    Route::get('/promotions', [ProduitController::class, 'promotions']);
    Route::get('/critique', [ProduitController::class, 'stockCritique']);
});

Route::get('/produit/top', [ProduitController::class, 'top10'])->middleware('auth:sanctum');

Route::get('/order/list', [OrderController::class, 'orders'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'auth.role:admin'])->group(function(){
    Route::get('/order/myorders', [OrderController::class, 'getUserOrders'])->middleware(['auth:sanctum', 'auth.role:client']);
    Route::post('/order', [OrderController::class, 'makeOrder'])->middleware('auth:sanctum');
});

Route::prefix('produit')->middleware(['auth:sanctum', 'auth.role:admin'])->group(function(){
    Route::put('/update/{id}', [ProduitController::class, 'update']);
    Route::get('/list', [ProduitController::class, 'index']);
    Route::post('/create', [ProduitController::class, 'store']);
    Route::get('/{slug}', [ProduitController::class, 'show']);
    Route::delete('/{id}', [ProduitController::class, 'destroy']);
});


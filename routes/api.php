<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Public
Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);

Route::group([
    'middleware' => 'auth:api',
], function() {
    // Auth
    Route::get('/profile', [\App\Http\Controllers\API\AuthController::class, 'profile']);
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

    // Category Product
    Route::prefix('category-products')->group(function() {
        Route::get('/', [\App\Http\Controllers\API\ProductCategoryController::class, 'all']);
        Route::post('/', [\App\Http\Controllers\API\ProductCategoryController::class, 'create']);
        Route::get('/{id}', [\App\Http\Controllers\API\ProductCategoryController::class, 'read']);
        Route::put('/{id}', [\App\Http\Controllers\API\ProductCategoryController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\API\ProductCategoryController::class, 'delete']);
    });

    // Product
    Route::prefix('products')->group(function() {
        Route::get('/', [\App\Http\Controllers\API\ProductController::class, 'all']);
        Route::post('/', [\App\Http\Controllers\API\ProductController::class, 'create']);
        Route::get('/{id}', [\App\Http\Controllers\API\ProductController::class, 'read']);
        Route::post('/{id}', [\App\Http\Controllers\API\ProductController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\API\ProductController::class, 'delete']);
    });
});
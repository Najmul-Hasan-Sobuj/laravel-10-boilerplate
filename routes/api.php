<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Api\CategoryApiController;
use App\Http\Controllers\User\Api\UserApiController;

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

// Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
// });

Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryApiController::class);
});

Route::post('/register', [UserApiController::class, 'register']);
Route::post('/login', [UserApiController::class, 'login']);
Route::post('/send-reset-password', [UserApiController::class, 'sendResetPassword']);
Route::post('/reset-password/{token}', [UserApiController::class, 'reset']);
Route::post('/forgot-password', [UserApiController::class, 'forgotPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserApiController::class, 'logout']);
    Route::post('/change-password', [UserApiController::class, 'updatePassword']);
    Route::get('/profile', [UserApiController::class, 'profile']);
    Route::put('/profile', [UserApiController::class, 'editProfile']);
});

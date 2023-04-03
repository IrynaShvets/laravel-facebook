<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::get('/post/all', [PostController::class, 'allData']);
    Route::post('/post/store', [PostController::class, 'store']);
    Route::get('/post/{post}/show', [PostController::class, 'show']);
    Route::patch('/post/{id}/update', [PostController::class, 'update']);
    Route::delete('/post/{id}/delete', [PostController::class, 'delete']);
    Route::get('get/file', function () {
        return Storage::download('/storage/app');
    });
    Route::post('avatar/file', [AuthController::class, 'uploadImage']);
});
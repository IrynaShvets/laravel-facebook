<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\Common\CommonController;
use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\PDFController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class)->except([
        'store', 'destroy'
    ]);
    

    Route::post('/friend/{id}', [UserController::class, 'addFriend']);
    Route::delete('/friend/{id}', [UserController::class, 'removeFriend']);

    Route::get('/user', [AuthController::class, 'getUser']);
    Route::get('/post/all', [PostController::class, 'list']);
    Route::post('/post/store', [PostController::class, 'store']);
    Route::get('/post/{post}/show', [PostController::class, 'show']);
    Route::post('/post/{id}/update', [PostController::class, 'update']);
    Route::delete('/post/{id}/delete', [PostController::class, 'delete']);

    Route::get('/chat/{user_id}', [ChatController::class, 'index']);
    Route::post('/chat/send', [ChatController::class, 'send']);

    Route::get('/common', [CommonController::class, 'list']);
    Route::get('/common/{common}/show', [CommonController::class, 'show']);
    Route::post('/common', [CommonController::class, 'create']);
    Route::post('/common/{id}', [CommonController::class, 'addMyself']);
    Route::delete('/common/{id}/delete', [CommonController::class, 'delete']);

    Route::get('generate/pdf', [PDFController::class, 'generatePDF']);
});

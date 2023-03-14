<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use \App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'as' => 'users.',
    'prefix' => 'users'
], function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/show', [UserController::class, 'show'])->name('show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{user}/update', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('destroy');
});

// Route::get('/', [AdminController::class, 'index'])->name('layouts.admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

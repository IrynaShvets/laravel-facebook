<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use \App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('layouts.admin')->with('status', session('status'));
    }
    return redirect()->route('layouts.admin');
});


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('layouts.admin');
    Route::resource('roles', RoleController::class)->except([
        'show'
    ]);

    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class)->except([
        'show'
    ]);
});

Route::get('get/file', function () {
    return Storage::download('/storage/app');
});

Auth::routes();

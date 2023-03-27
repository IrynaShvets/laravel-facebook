<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use \App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
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

Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('layouts.admin');
    Route::resource('roles', RoleController::class);
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class)->except([
        'show', 'edit', 'update'
    ]);
});

Route::get('get/file', function () {
    return Storage::download('/storage/app');
});

Auth::routes();

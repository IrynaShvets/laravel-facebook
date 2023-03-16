<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\Post\PostController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
|
*/
Route::get('/', [AdminController::class, 'index'])->name('layouts.admin');

Route::group([
    'as' => 'admin.posts.',
    'prefix' => 'posts'
], function() {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/create', [PostController::class, 'store'])->name('store');
    Route::get('/{post}/show', [PostController::class, 'show'])->name('show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::patch('/{post}/update', [PostController::class, 'update'])->name('update');
    Route::delete('/{post}/delete', [PostController::class, 'destroy'])->name('destroy');
});



// Route::get('/', function () {
//     return view('admin')->name('admin');
// });
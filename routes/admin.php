<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
|
*/
Route::get('/', [AdminController::class, 'index'])->name('layouts.admin');
// Route::get('/', function () {
//     return view('admin')->name('admin');
// });
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/get/blogs', [App\Http\Controllers\HomeController::class, 'getBlogs'])->name('home.blogs');
Route::get('/admin/home', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('admin.home');
Route::resource('subscribers', \App\Http\Controllers\SubscriberController::class);
Route::resource('blogs', \App\Http\Controllers\BlogController::class);

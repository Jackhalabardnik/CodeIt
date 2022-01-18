<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\TaskController::class, 'index'])->name('task.index');

Route::get('/task/create', [App\Http\Controllers\TaskController::class, 'create'])->name('task.create');

Route::post('/task/create/store', [App\Http\Controllers\TaskController::class, 'store'])->name('task.store');

Route::get('/task/{task}/details', [App\Http\Controllers\TaskController::class, 'show'])->name('task.show');

Route::get('/task/{task}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('task.edit');

Route::post('/task/{task}/update', [App\Http\Controllers\TaskController::class, 'update'])->name('task.update');

Route::post('/task/{task}/delete/perm', [App\Http\Controllers\TaskController::class, 'destroy'])->name('task.remove');

Route::get('/task/{task}/delete', [App\Http\Controllers\TaskController::class, 'delete'])->name('task.delete');

Route::get('/user/{user}/home', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');

Route::post('/user/{user}/delete/perm', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.remove');

Route::get('/user/{user}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');

Route::post('/user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');



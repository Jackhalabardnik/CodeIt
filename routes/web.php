<?php

use Illuminate\Http\Request;
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

Route::get('/task/{task}', [App\Http\Controllers\TaskController::class, 'show'])->name('task.show');

Route::get('/user/{user}/home', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');

Route::post('/user/{user}/delete/perm', [App\Http\Controllers\UserController::class, 'remove'])->name('user.remove');

Route::get('/user/{user}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');

Route::post('/user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');



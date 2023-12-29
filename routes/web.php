<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::view('/register', 'register')->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::view('/login', 'login')->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function() {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::prefix('category')->group(function () {
        Route::middleware('admin')->group(function () {
            Route::get('/list', [CategoryController::class, 'list'])->name('category.list');
            Route::get('/create', [CategoryController::class, 'index'])->name('category.create');
            Route::get('/edit/{id}', [CategoryController::class, 'index'])->name('category.update');
            Route::post('/save', [CategoryController::class, 'save'])->name('category.save');
            Route::delete('/remove/{id}', [CategoryController::class, 'delete'])->name('category.remove');
            Route::patch('/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
        });
    });

    Route::prefix('task')->group(function () {
        Route::get('/list', [TaskController::class, 'list'])->name('task.list');
        Route::view('/create', 'task.task-create')->name('task.form');
        Route::post('/create', [TaskController::class, 'create'])->name('task.create');
        Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
        Route::post('/update/{id}', [TaskController::class, 'update'])->name('task.update');
        Route::delete('/remove/{id}', [TaskController::class, 'delete'])->name('task.remove');
        Route::patch('/restore/{id}', [TaskController::class, 'restore'])->name('task.restore');
    });

});

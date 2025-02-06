<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListeingController;
use App\Http\Controllers\ListeingImageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RealtorListeingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'loginSave'])->name('login.save');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerSave'])->name('register.save');
});


Route::middleware('auth:web')->group(function () {
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('task/done/{id}', [TaskController::class, 'done'])->name('task.done');
    Route::get('task/force/delete/{id}', [TaskController::class, 'forceDelete'])->name('task.forceDelete');
    Route::get('task/restore/{id}', [TaskController::class, 'restore'])->name('task.restore');
    Route::resource('tasks', TaskController::class)->except('show');
});

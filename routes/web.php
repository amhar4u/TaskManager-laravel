<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
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

Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('post-login',[AuthController::class,'postLogin'])->name('login.post');
Route::get('registration',[AuthController::class,'register'])->name('registration');
Route::post('post-registration',[AuthController::class,'postRegistration'])->name('registration.post');

Route::middleware(['auth'])->group(function () {
    Route::get('index', [AuthController::class, 'home'])->name('home')->middleware('preventBackHistory'); // Apply the custom middleware.
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('newtask', [TaskController::class, 'newtask'])->name('newtask');
    Route::post('store', [TaskController::class, 'store'])->name('store');
    Route::post('tasks/{id}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/{task}',[TaskController::class, 'update'])->name('tasks.update');
    Route::get('high', [TaskController::class, 'getHighPriorityTasks'])->name('high.tasks');
    Route::get('low', [TaskController::class, 'getLowPriorityTasks'])->name('low.tasks');
    Route::get('medium', [TaskController::class, 'getMediumPriorityTasks'])->name('medium.tasks');
    
});

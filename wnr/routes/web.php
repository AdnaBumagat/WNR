<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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



// Landing page (public)
Route::get('/', function () {
    return view('landing');
})->name('home');

// Dashboard for authenticated users (regular users)
Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin dashboard route protected by 'admin' middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// User profile routes (accessible by authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Routes for managing users
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::patch('/admin/users/{id}/update-role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::patch('/admin/users/{id}/block', [UserController::class, 'blockUser'])->name('admin.users.block');
    Route::delete('/admin/users/{id}', [UserController::class, 'deleteUser'])->name('admin.users.delete');
});






require __DIR__.'/auth.php';

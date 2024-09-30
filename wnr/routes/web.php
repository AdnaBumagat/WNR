<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route to show the book submission form
Route::get('/books/create', [BookController::class, 'create'])->name('books.create')->middleware('auth');

// Route to store the book
Route::post('/books', [BookController::class, 'store'])->name('books.store')->middleware('auth');

// Route to display all approved books
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Admin routes to approve books
Route::get('/admin/books', [BookController::class, 'adminIndex'])->name('admin.books')->middleware('auth');
Route::post('/admin/books/{id}/approve', [BookController::class, 'approve'])->name('books.approve')->middleware('auth');


require __DIR__.'/auth.php';

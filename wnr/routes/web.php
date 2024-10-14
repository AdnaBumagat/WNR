<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReaderController;

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



Route::get('/', [HomeController::class, 'index'])->name('home');

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

// Route for Books
Route::middleware(['auth'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
});

//Route for chapters

Route::middleware(['auth'])->group(function () {
    Route::get('/books/{bookId}/chapters/create', [ChapterController::class, 'create'])->name('chapters.create');
    Route::post('/books/{bookId}/chapters', [ChapterController::class, 'store'])->name('chapters.store');
});


// Books
Route::middleware(['auth'])->group(function () {
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

    // Chapters
    Route::get('/chapters/{id}/edit', [ChapterController::class, 'edit'])->name('chapters.edit');
    Route::patch('/chapters/{id}', [ChapterController::class, 'update'])->name('chapters.update');
    Route::delete('/chapters/{id}', [ChapterController::class, 'destroy'])->name('chapters.destroy');
    Route::get('/chapters/{id}', [ChapterController::class, 'show'])->name('chapters.show');  // View full chapter content
});

Route::post('/books/{id}/publish', [BookController::class, 'publish'])->name('books.publish');


// Admin book approval routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/approvals', [AdminController::class, 'approvalRequests'])->name('admin.approvals.index');
    Route::get('/admin/approvals/{id}', [AdminController::class, 'showBook'])->name('admin.approvals.showBook');
    Route::get('/admin/approvals/chapters/{id}', [AdminController::class, 'showChapter'])->name('admin.approvals.showChapter'); // Show full chapter content
    Route::patch('/admin/approvals/{id}/approve', [AdminController::class, 'approveBook'])->name('admin.approveBook');
    Route::delete('/admin/approvals/{id}/reject', [AdminController::class, 'rejectBook'])->name('admin.rejectBook');
});

// Admin routes to manage approved books
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/library', [AdminController::class, 'approvedBooks'])->name('admin.library.index'); // View all approved books
    Route::patch('/admin/library/{id}/toggle-featured', [AdminController::class, 'toggleFeatured'])->name('admin.library.toggleFeatured'); // Toggle featured status
    // Route to export approved books to CSV
    Route::get('/admin/library/export-csv', [AdminController::class, 'exportApprovedBooksToCSV'])->name('admin.library.export-csv');
    Route::get('/admin/users/export', [UserController::class, 'exportUsersToCSV'])->name('users.export');

});


// Reader routes
Route::middleware(['auth'])->group(function () {
    Route::get('/readers/{id}', [ReaderController::class, 'show'])->name('readers.show'); // View reader details (previously book)
    Route::get('/readers/{bookId}/chapters/{chapterId}', [ReaderController::class, 'showChapter'])->name('readers.chapters.show'); // View chapter in reader (previously book)
});







require __DIR__.'/auth.php';

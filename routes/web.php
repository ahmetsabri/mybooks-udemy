<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TimelineController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('dashboard', [BookController::class, 'index'])->name('dashboard');

    Route::prefix('my-books')->group(function () {
        Route::view('create', 'my_books.create')->name('my_books.create');
        Route::post('/', [BookController::class, 'store'])->name('my_books.store');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('my_books.edit');
        Route::post('/{book}/update', [BookController::class, 'update'])->name('my_books.update');
        Route::delete('/{book}/delete-image', [BookController::class, 'deleteImage'])->name('my_books.delete_image');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('my_books.delete');
    });

    Route::post('/{book}/toggle-like', [TimelineController::class, 'toggleLike'])->name('my_books.toggle_like');
});

require __DIR__.'/auth.php';

Route::get('/{book}', [TimelineController::class, 'show'])->name('books.show');

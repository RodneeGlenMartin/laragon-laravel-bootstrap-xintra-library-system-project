<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard (Default)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Global Search API
    Route::get('/search', [DashboardController::class, 'search'])->name('search');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource Routes
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);
    Route::resource('students', StudentController::class);
    Route::resource('transactions', TransactionController::class);
});
require __DIR__.'/auth.php';

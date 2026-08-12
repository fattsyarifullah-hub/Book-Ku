<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

// Route untuk subdomain dashboard
Route::domain('dashboard.booku.local')->group(function() {

    Route::middleware(['auth', 'admin'])->group(function () {
        // Route bawaan breeze
    Route::get('/', function () {
        return view('dashboard.dashboard');
    })->middleware('verified')->name('dashboard');
    
        Route::get('/profile', [ProfileController::class, 'editAdmin'])->name('dashboard.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('book')->group(function() {
            Route::get('/', [BookController::class, 'index'])->name('dashboard.book.index');
            Route::get('/create', [BookController::class, 'create'])->name('dashboard.book.create');
            Route::post('/', [BookController::class, 'store'])->name('dashboard.book.store');
            Route::get('/{id}', [BookController::class, 'show'])->name('dashboard.book.show');
            Route::get('/edit/{id}', [BookController::class, 'edit'])->name('dashboard.book.edit');
            Route::put('/edit/{id}', [BookController::class, 'update'])->name('dashboard.book.update');
            Route::delete('/{id}', [BookController::class, 'destroy'])->name('dashboard.book.destroy');
        });
        
        Route::prefix('category')->group(function() {
            Route::get('/', [CategoryController::class, 'index'])->name('dashboard.category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('dashboard.category.create');
            Route::post('/', [CategoryController::class, 'store'])->name('dashboard.category.store');
            Route::get('/{id}', [CategoryController::class, 'show'])->name('dashboard.category.show');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('dashboard.category.edit');
            Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('dashboard.category.update');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('dashboard.category.destroy');
        });

        Route::prefix('user')->group(function() {
            Route::get('/', [UserController::class, 'index'])->name('dashboard.user.index');
            Route::get('/{id}', [UserController::class, 'show'])->name('dashboard.user.show');
            Route::patch('/{user}', [UserController::class, 'updateRole'])->name('dashboard.user.updateRole');
        });

        Route::prefix('order')->group(function() {
            Route::get('/', [OrderController::class, 'index'])->name('dashboard.order.index');
        });
    });
});

// Route untuk domain utama
Route::get('/', [HomeController::class, 'index'])->name('main.index');

Route::prefix('catalog')->group(function() {
    Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/{id}', [CatalogController::class, 'show'])->name('catalog.show');
    Route::get('/search', [CatalogController::class, 'search'])->name('catalog.search');
});


Route::prefix('cart')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
});


// Route bawaan breeze 
    Route::middleware('auth')->group(function () {
        Route::get('/account', [ProfileController::class, 'editCustomer'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
require __DIR__.'/auth.php';

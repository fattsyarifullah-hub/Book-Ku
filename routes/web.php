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
use App\Http\Controllers\OrderCustomerController;
use App\Http\Controllers\MidtransNotifController;
use App\Http\Controllers\DashboardController;

// Route untuk subdomain dashboard
Route::domain('dashboard.booku.local')->group(function() {

    Route::middleware(['auth', 'admin'])->group(function () {
        // Route bawaan breeze
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('verified');
    
        Route::get('/profile', [ProfileController::class, 'editAdmin'])->name('dashboard.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'updateAdmin'])->name('profile.update');
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
            Route::get('/{order}', [OrderController::class, 'show'])->name('dashboard.order.show');
            Route::patch('/{order}', [OrderController::class, 'updateStatus'])->name('dashboard.order.updateStatus');
        });
    });
});

// Route untuk domain utama
Route::get('/', [HomeController::class, 'index'])->name('main.index');

Route::prefix('catalog')->group(function() {
    Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/{book}', [CatalogController::class, 'show'])->name('catalog.show');
    Route::get('/search', [CatalogController::class, 'search'])->name('catalog.search');
});


    Route::prefix('cart')->group(function() {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
        Route::post('/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
        Route::post('/checkout', [CartController::class, 'checkoutByCart'])->name('cart.checkoutByCart');
    })->middleware('auth'); 

    Route::get('/checkout', [OrderCustomerController::class, 'create'])->name('order.checkout');

    Route::prefix('orders')->group(function() {
        Route::post('/', [OrderCustomerController::class, 'store'])->name('order.store');
        Route::get('/{order}/pay', [OrderCustomerController::class, 'pay'])->name('order.pay');
        Route::get('/{order}/invoice', [OrderCustomerController::class, 'invoice'])->name('order.invoice');
    })->middleware('auth');

    Route::post('/midtrans/notification', [MidtransNotifController::class, 'handle'])->name('midtrans.notification');


// Route bawaan breeze 
    Route::middleware('auth')->group(function () {
        Route::get('/account', [ProfileController::class, 'editCustomer'])->name('customer.edit');
        Route::patch('/account', [ProfileController::class, 'updateCustomer'])->name('customer.update');
        Route::delete('/account', [ProfileController::class, 'destroy'])->name('customer.destroy');
    });
require __DIR__.'/auth.php';

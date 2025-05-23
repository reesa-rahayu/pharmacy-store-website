<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminCustomerController;

// Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/guestbook', [GuestBookController::class, 'index'])->name('guestbook.index');
Route::post('/guestbook', [GuestBookController::class, 'store'])->name('guestbook.store');

// Authentication Routes (already included via auth.php)
require __DIR__ . '/auth.php';

// Customer Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/report', [OrderController::class, 'report'])->name('orders.report');
    Route::get('/orders/{order}/download', [OrderController::class, 'download'])->name('orders.download');
    Route::get('/orders/{order}/email', [OrderController::class, 'emailReport'])->name('orders.email');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Rating Routes
    Route::post('/products/{product}/rate', [RatingController::class, 'store'])->name('ratings.store');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('products', AdminProductController::class);

    Route::resource('categories', AdminCategoryController::class);
    Route::resource('customers', AdminCustomerController::class);
    Route::resource('orders', AdminOrderController::class);

    // Customer Management
    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{user}', [AdminCustomerController::class, 'show'])->name('customers.show');

    // Guest Book Management
    Route::get('/guestbook', [GuestBookController::class, 'adminIndex'])->name('guestbook.index');
    Route::delete('/guestbook/{entry}', [GuestBookController::class, 'destroy'])->name('guestbook.destroy');

    // Shop Management
    Route::get('/shops/pending', [ShopController::class, 'pending'])->name('shops.pending');
    Route::patch('/shops/{shop}/approve', [ShopController::class, 'approve'])->name('shops.approve');
    Route::patch('/shops/{shop}/reject', [ShopController::class, 'reject'])->name('shops.reject');

    // Order Management
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.index');
    Route::patch('/orders/{order}/ship', [OrderController::class, 'ship'])->name('orders.ship');
});

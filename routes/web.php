<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Editor\DashboardController;
use App\Http\Controllers\Editor\EditorProductController;
use App\Http\Controllers\Editor\EditorCategoryController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/product/{slug}', [HomeController::class, 'product'])->name('product.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/cart', [CartController::class, 'view'])->name('cart');

// Cart routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    
    // Orders routes
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
    
    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
});

// Admin routes
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Users
    Route::resource('users', UserController::class);
    
    // Products
    Route::resource('products', ProductController::class);
    Route::patch('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.toggle-featured');
    
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Orders
    Route::resource('orders', OrderController::class);
    Route::put('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
});

// Editor Routes
Route::middleware(['auth', CheckRole::class.':editor'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // Products
    Route::resource('products', EditorProductController::class);
    Route::patch('products/{product}/toggle-featured', [EditorProductController::class, 'toggleFeatured'])->name('products.toggle-featured');
    
    // Categories
    Route::resource('categories', EditorCategoryController::class);
});

require __DIR__.'/auth.php';

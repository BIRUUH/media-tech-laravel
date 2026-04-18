<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminMessageController;

// User Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Product Routes
Route::get('/belanja', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// Wishlist Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

// Order Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('orders.place');
    Route::get('/order/{id}/download-pdf', [OrderController::class, 'downloadPdf'])->name('orders.download-pdf');
});

// Contact Routes
Route::get('/hubungikami', [MessageController::class, 'create'])->name('contact');
Route::post('/hubungikami', [MessageController::class, 'store'])->name('messages.store');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Auth
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Products Management
        Route::resource('products', AdminProductController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy'
        ]);

        // Orders Management
        Route::get('/lists', [AdminOrderController::class, 'list'])->name('admin.pesens.list');
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.pesens.show');
        Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.pesens.updateStatus');
        Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('admin.pesens.destroy');
        Route::get('/orders/{id}/download-pdf', [AdminOrderController::class, 'downloadPdf'])->name('admin.pesens.download-pdf');

        // Messages Management
        Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
        Route::delete('/messages/{id}', [AdminMessageController::class, 'destroy'])->name('admin.messages.destroy');
    });
});
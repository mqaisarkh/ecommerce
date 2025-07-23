<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BlogController as BackendBlogController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// page
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/custom-login', [PageController::class, 'login'])->name('custom.login');
Route::get('/custom-register', [PageController::class, 'register'])->name('custom.register');
Route::get('/mail-success', [PageController::class, 'mailSuccess'])->name('mail.success');
Route::get('/error', [PageController::class, 'error'])->name('error');
Route::get('/forgot-password', [PageController::class, 'forgotPassword'])->name('forgot.password');

// Product
Route::get('/products/{slug?}', [FrontendProductController::class, 'product_grid'])->name('product.grid');

Route::get('/product-single', [FrontendProductController::class, 'product_single'])->name('product.detail');
Route::get('product/{slug}', [FrontendProductController::class, 'show'])->name('product.show');



Route::get('/cart', [FrontendProductController::class, 'cart'])->name('cart');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/checkout', [FrontendProductController::class, 'checkout'])->name('checkout');

// blog

Route::get('/blog-grid-sidebar', [BlogController::class, 'gridSidebar'])->name('blog.grid.sidebar');
Route::get('/blog-single/{slug}', [BlogController::class, 'single'])->name('blog.single');
Route::get('/blog-single-sidebar', [BlogController::class, 'singleSidebar'])->name('blog.single.sidebar');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// cart
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/checkout/shipping-address', [CheckoutController::class, 'storeShipping'])->name('shipping.store');


Route::get('/checkout_stripe', [CheckoutController::class, 'checkout'])->middleware('auth')->name('checkout.stripe');


Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');


Route::get('/checkout/cancel', function () {
    return redirect()->route('cart');
})->name('checkout.cancel');

// backend

Auth::routes();

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [BackendHomeController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::resource('users', UserController::class);

    // categoreis routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
    // prodcuts routes
    Route::get('/products/list', [ProductController::class, 'index'])->name('products.list');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('products.delete');
    Route::delete('/products/images/{imageId}', [ProductController::class, 'destroyImage'])->name('product.images.destroy');

    // blogs routes
    Route::get('/blogs', [BackendBlogController::class, 'index'])->name('blogs.list');
    Route::get('/blogs/create', [BackendBlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BackendBlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}/edit', [BackendBlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BackendBlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BackendBlogController::class, 'destroy'])->name('blogs.destroy');

    // setting routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.list');

    // Profile Management Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.update_password');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProductVariantController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;

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

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/api/check-role', function () {
        return response()->json(['authenticated' => Auth::check(), 'role' => Auth::user()->role]);
    });
});

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('product-variants', ProductVariantController::class);

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');

Route::prefix('products')->group(function () {
    Route::get('/hot/{categoryId}', [ProductController::class, 'getHotProductsByCategory'])->name('user.products.hot');
    Route::get('/category/{categoryId}', [ProductController::class, 'getByCategory'])->name('user.products.category');
});

Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('news.index');
    Route::get('/{id}', [NewsController::class, 'show'])->name('news.show');
});

Route::prefix('user')->middleware('auth', 'role:user')->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('', [CartController::class, 'show'])->name('cart.show');
        Route::post('add', [CartController::class, 'createOrUpdateCart'])->name('cart.add');
        Route::post('update', [CartController::class, 'updateCartItemQuantity'])->name('cart.update');
        Route::delete('delete', [CartController::class, 'deleteCartItem'])->name('cart.delete');
        Route::delete('delete-all', [CartController::class, 'deleteAllCartItems'])->name('cart.deleteAll');
    });

    Route::get('/payment', [CartController::class, 'showPaymentPage'])->name('payment.show');
    Route::post('/order/submit', [OrderController::class, 'submitOrder'])->name('order.submit');
});

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

Route::resource('categories', CategoryController::class);

Route::resource('products', ProductController::class);

Route::resource('product-variants', ProductVariantController::class);

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');
Route::get('products/hot/{categoryId}', [ProductController::class, 'getHotProductsByCategory'])->name('user.products.hot');
Route::get('products/category/{categoryId}', [ProductController::class, 'getByCategory'])->name('user.products.category');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

Route::prefix('user')->middleware('auth', 'role:user')->group(function () {
    Route::post('cart/add', [CartController::class, 'createOrUpdateCart'])->name('cart.add');
    Route::get('cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('cart/update', [CartController::class, 'updateCartItemQuantity'])->name('cart.update');
    Route::delete('cart/delete', [CartController::class, 'deleteCartItem'])->name('cart.delete');
    Route::delete('cart/delete-all', [CartController::class, 'deleteAllCartItems'])->name('cart.deleteAll');
});

Route::middleware('auth')->group(function () {
    Route::get('/api/check-role', function () {
        return response()->json(['authenticated' => Auth::check(), 'role' => Auth::user()->role]);
    });
});

// Route::prefix('user')->middleware('role:user')->group(function () {
//     Route::resource('products', ProductController::class);
//     Route::get('products/category/{categoryId}', [ProductController::class, 'getByCategory'])->name('user.products.category');
//     Route::get('products/hot/{categoryId}', [ProductController::class, 'getHotProductsByCategory'])->name('user.products.hot');
// });


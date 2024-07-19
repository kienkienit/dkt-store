<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProductVariantController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductVariantController as AdminProductVariantController;

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

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('manage')->group(function () {
        Route::prefix('products')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('admin.manage.products');
            Route::post('/', [AdminProductController::class, 'store'])->name('admin.manage.products.create');
            Route::get('/{id}', [AdminProductController::class, 'show'])->name('admin.manage.products.show');
            Route::post('/{id}', [AdminProductController::class, 'update'])->name('admin.manage.products.update');
            Route::delete('/{id}', [AdminProductController::class, 'delete'])->name('admin.manage.products.delete');

            Route::prefix('{product_id}/variants')->group(function () {
                Route::get('/', [AdminProductVariantController::class, 'index'])->name('admin.manage.product_variants');
                Route::post('/', [AdminProductVariantController::class, 'store'])->name('admin.manage.product_variants.create');
                Route::get('/{variant_id}', [AdminProductVariantController::class, 'show'])->name('admin.manage.product_variants.show');
                Route::post('/{variant_id}', [AdminProductVariantController::class, 'update'])->name('admin.manage.product_variants.update');
                Route::delete('/{variant_id}', [AdminProductVariantController::class, 'delete'])->name('admin.manage.product_variants.delete');
            });
        });
        Route::prefix('orders')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('admin.manage.orders');
            Route::get('/{id}', [AdminOrderController::class, 'show'])->name('admin.manage.orders.show');
            Route::post('/{id}', [AdminOrderController::class, 'update'])->name('admin.manage.orders.update');
            Route::get('/{id}/detail', [AdminOrderController::class, 'detail'])->name('admin.manage.orders.detail');
        });
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.manage.users');
            Route::post('/', [UserController::class, 'store'])->name('admin.manage.users.create');
            Route::get('/{id}', [UserController::class, 'show'])->name('admin.manage.users.show');
            Route::post('/{id}', [UserController::class, 'update'])->name('admin.manage.users.update');
            Route::delete('/{id}', [UserController::class, 'delete'])->name('admin.manage.users.delete');
        });
        Route::prefix('news')->group(function () {
            Route::get('/', [AdminNewsController::class, 'index'])->name('admin.manage.news');
            Route::post('/', [AdminNewsController::class, 'store'])->name('admin.manage.news.create');
            Route::get('/{id}', [AdminNewsController::class, 'show'])->name('admin.manage.news.show');
            Route::post('/{id}', [AdminNewsController::class, 'update'])->name('admin.manage.news.update');
            Route::delete('/{id}', [AdminNewsController::class, 'delete'])->name('admin.manage.news.delete');
        });
    });
    Route::prefix('statistics')->group(function () {
        Route::get('/', [StatisticsController::class, 'index'])->name('admin.statistics.index');
        Route::get('/revenue/{year}', [StatisticsController::class, 'getRevenueByMonth'])->name('admin.statistics.revenue');
        Route::get('/orders/{year}', [StatisticsController::class, 'getOrdersByMonth'])->name('admin.statistics.orders');
    });
});
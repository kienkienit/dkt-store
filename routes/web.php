<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/product_detail', function () {
    return view('pages.product_detail');
})->name('product_detail');

Route::get('/cart', function () {
    return view('pages.cart');
})->name('cart');

Route::get('/payment', function () {
    return view('pages.payment');
})->name('payment');

Route::get('/news', function () {
    return view('pages.news');
})->name('news');

Route::get('/news_detail', function () {
    return view('pages.news_detail');
})->name('news_detail');

Route::get('/manage_products', function () {
    return view('admin.manage_products');
})->name('news_detail');

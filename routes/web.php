<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

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
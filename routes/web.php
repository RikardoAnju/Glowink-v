<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashbuyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\CanDeleteData;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/add_barang', function () {
    return view('add_barang');
});

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/detailproduk', [DetailProdukController::class, 'detailproduk'])->name('detailproduk');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/pesanan', [PesananController::class, 'pesanan'])->name('pesanan');
Route::get('/dashbuy', [DashbuyController::class, 'dashbuy'])->name('dashbuy');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/adminpage', [AdminpageController::class, 'index']);
    Route::delete('/api/categories/{id}', [CategoryController::class, 'destroy'])->middleware([CanDeleteData::class]);
    
});

//kategori
Route::get('/kategori', [CategoryController::class, 'list']);
Route::get('/categories/{id}', 'CategoryController@show');


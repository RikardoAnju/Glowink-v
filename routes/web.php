<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\addbarangController;
use App\Http\Controllers\login2Controller;
use App\Http\Controllers\registercontroller;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\detailprodukController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\LoginMiddleware;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/kategori', function () {
    return view('kategori');
});

Route::get('/add_barang', function () {
    return view('add_barang');
});

Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/detailproduk', [detailprodukController::class , 'detailproduk']);
Route::get('/register', [registerController::class , 'register']);
Route::get('/checkout', [checkoutController::class , 'checkout']);
Route::get('/cart', [cartController::class , 'cart']);



Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);


Route::get('/adminpage', [AdminpageController::class, 'index'])->middleware([LoginMiddleware::class]);


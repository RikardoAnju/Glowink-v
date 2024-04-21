<?php
use App\Http\Controllers\addbarangController;
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\detailprodukController;
use App\Http\Controllers\kategoriController;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;

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



Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);


Route::get('/adminpage', [AdminpageController::class, 'index'])->middleware([LoginMiddleware::class]);


<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\addbarangController;
use App\Http\Controllers\loginnController;
use App\Http\Controllers\registercontroller;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\detailprodukController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\dashbuyController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\LoginnMiddleware;

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
// Route::get('/loginn', [loginnController::class, 'loginn']);
Route::get('/detailproduk', [detailprodukController::class , 'detailproduk']);
Route::get('/register', [registercontroller::class , 'register']);
Route::get('/checkout', [checkoutController::class , 'checkout']);
Route::get('/cart', [cartController::class , 'cart']);
Route::get('/pesanan', [pesananController::class , 'pesanan']);
Route::get('/dashbuy', [dashbuyController::class , 'dashbuy']);



Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);


Route::get('loginn', [AuthController::class, 'loginn']);
Route::post('loginn', [AuthController::class, 'loginn']);
Route::get('logout', [AuthController::class, 'logout']);



Route::get('/adminpage', [AdminpageController::class, 'index'])->middleware([LoginMiddleware::class]);


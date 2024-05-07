<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestimoniController;
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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
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
    Route::delete('/api/subcategories/{id}', [SubcategoryController::class, 'destroy'])->middleware([CanDeleteData::class]);
  
    
});

//kategori
Route::get('/kategori', [CategoryController::class, 'list']);
Route::get('/subkategori',[SubcategoryController::class, 'list']);
Route::get('/slider',[SliderController::class, 'list']);
Route::get('/barang',[ProductController::class, 'list']);
Route::get('/tesmoni',[TestimoniController::class, 'list']);
Route::get('/review',[ReviewController::class, 'list']);






Route::get('/categories/{id}', 'CategoryController@show');
Route::get('/subcategories/{id}', 'subCategoryController@show');
Route::put('/subcategories/{subcategory}', 'SubcategoryController@update');





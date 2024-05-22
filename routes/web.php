<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashbuyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Middleware\CanDeleteData;

//Route::get('/', function () {
    //return view('dashboard');
//});

Route::get('/add_barang', function () {
    return view('add_barang');
});

//Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
//Route::get('/detailproduk', [DetailProdukController::class, 'detailproduk'])->name('detailproduk');
//Route::get('/register', [RegisterController::class, 'register'])->name('register');

//Route::get('/pesanan', [PesananController::class, 'pesanan'])->name('pesanan');
//Route::get('/dashbuy', [DashbuyController::class, 'dashbuy'])->name('dashbuy');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('login_member', [AuthController::class, 'login_member']);
Route::post('login_member', [AuthController::class, 'login_member_action']);
Route::post('logout_member', [AuthController::class, 'logout_member']);

Route::get('register_member', [AuthController::class, 'register_member']);
Route::post('register_member', [AuthController::class, 'register_member_action']);
Route::post('/login_member_action', [AuthController::class, 'login_member_action'])->name('login_member_action');



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
Route::get('/testimonis', [TestimoniController::class, 'index']);


//pesanan

Route::get('/pesanan/baru',[OrderController::class, 'list']);
Route::get('/pesanan/dikomfirmasi',[OrderController::class, 'dikomfirmasi_list']);
Route::get('/pesanan/dikemas',[OrderController::class, 'dikemas_list']);
Route::get('/pesanan/dikirim',[OrderController::class, 'dikirim_list']);
Route::get('/pesanan/diterima',[OrderController::class, 'diterima_list']);
Route::get('/pesanan/selesai',[OrderController::class, 'selesai_list']);
Route::get('/laporan',[ReportController::class, 'index']);


//payment
Route::get('/payment', [PaymentController::class, 'list']);



//category




// subcategory
Route::get('/categories/{id}', 'CategoryController@show');
Route::get('/subcategories/{id}', 'subCategoryController@show');
Route::put('/subcategories/{subcategory}', 'SubcategoryController@update');




// home route
Route::get('/', [HomeController::class, 'index']);
Route::get('/products/{category}', [HomeController::class, 'products']);
Route::get('/product/{id}', [HomeController::class, 'product']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/orders', [HomeController::class, 'orders']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/faq', [HomeController::class, 'faq']);



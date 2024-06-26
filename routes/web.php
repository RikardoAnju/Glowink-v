<?php

use App\Http\Controllers\CartController;
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
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TentangController;
use App\Http\Middleware\CanDeleteData;

//Route::get('/', function () {
    //return view('dashboard');
//});

Route::get('/add_barang', function () {
    return view('add_barang');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('login_member', [AuthController::class, 'login_member']);
Route::post('login_member', [AuthController::class, 'login_member_action']);
Route::get('logout_member', [AuthController::class, 'logout_member']);

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
Route::get('/members', [MemberController::class, 'list']);
Route::get('/subkategori',[SubcategoryController::class, 'list']);
Route::get('/slider',[SliderController::class, 'list']);
Route::get('/barang',[ProductController::class, 'list']);
Route::get('/tesmoni',[TestimoniController::class, 'list']);
Route::get('/review',[ReviewController::class, 'list']);
Route::get('/testimonis', [TestimoniController::class, 'index']);


//pesanan

Route::get('/pesanan/baru',[OrderController::class, 'list']);
Route::get('/laporan',[ReportController::class, 'index']);


Route::get('/tentang', [TentangController::class, 'index'])->name('tentang.index');
Route::put('/tentang/{about}', [TentangController::class, 'update'])->name('tentang.update');



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
Route::get('/orders', [HomeController::class, 'orders'])->name('orders');
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::post('/add_to_cart', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/delete_from_cart/{cart}', [HomeController::class, 'delete_from_cart']);
Route::get('/get_kota/{id}', [HomeController::class, 'get_kota']);
//Route::get('/get_ongkir/{destination}/{weight}', [HomeController::class, 'get_kota']);


Route::post('/checkout_orders', [HomeController::class, 'checkout_orders']);

Route::post('/payments/upload', [HomeController::class, 'payments'])->name('payments.upload');
Route::post('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/pesanan_selesai/{order}', [HomeController::class, 'pesanan_selesai']);
Route::post('/payments', [HomeController::class, 'payments'])->name('payments');
Route::post('/payments', [HomeController::class, 'payment'])->name('payments');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments');
//Route::get('/get_ongkir/{destination}', [ShippingController::class, 'getOngkir']);
Route::post('/payments', [HomeController::class, 'payments']);



Route::get('/get_ongkir/{destination}', [ShippingController::class, 'getOngkir']);


///paymeny


Route::post('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/midtrans-callback', [PaymentController::class, 'callback'])->name('payments.callback');

Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/pending', [PaymentController::class, 'pending'])->name('payment.pending');
Route::get('/payment/error', [PaymentController::class, 'error'])->name('payment.error');
Route::get('/orders/{id}', [OrderController::class, 'index'])->name('orders');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::post('/cart/checkout', [ProductController::class, 'checkout'])->name('cart.checkout');

//Search
Route::get('/search/customer', [SearchController::class, 'searchCustomer'])->name('search.customer');
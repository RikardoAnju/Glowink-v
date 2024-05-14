<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PesananController; // Pastikan huruf P besar
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController; 
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('admin', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group([
    'middleware' => 'api'
], function () {
    Route::resources([
        'categories' => CategoryController::class,
        'subcategories' => SubcategoryController::class,
        'sliders'=> SliderController::class,
        'products'=> ProductController::class,
        'members'=>MemberController::class,
        'testimonis'=>TestimoniController::class,
        'reviews'=>ReviewController::class,
        'orders'=>OrderController::class,
    ]);

    // Penyesuaian rute update
    Route::put('sliders/{slider}', [SliderController::class, 'update']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::put('subcategories/{subcategory}', [SubcategoryController::class, 'update']);
    Route::put('testimonis/{testimoni}', [TestimoniController::class, 'update']);

    // Rute untuk mengubah status pesanan
    Route::post('orders/ubah_status/{order}', [OrderController::class, 'ubah_Status']);

    // Rute-rute untuk status pesanan
    Route::get('pesanan/baru', [OrderController::class, 'baru']);
    Route::get('pesanan/dikemas', [OrderController::class, 'dikemas']);
    Route::get('pesanan/dikirim', [OrderController::class, 'dikirim']);
    Route::get('pesanan/diterima', [OrderController::class, 'diterima']);
    Route::get('pesanan/selesai', [OrderController::class, 'selesai']);

    // Rute khusus pesanan yang memerlukan autentikasi
    Route::middleware('auth:api')->group(function () {
        Route::get('/pesanan/komfirmasi', [PesananController::class, 'getKomfirmasiPesanan']);
        Route::get('/pesanan/kemas', [PesananController::class, 'getKemasPesanan']);
        Route::get('/pesanan/kirim', [PesananController::class, 'getKirimPesanan']);
        Route::get('/pesanan/terima', [PesananController::class, 'getTerimaPesanan']);
        Route::get('/pesanan/selesai', [PesananController::class, 'getSelesaiPesanan']);
        Route::post('/pesanan/ubah_status/{id}', [PesananController::class, 'ubahStatus']);
    });
    // Rute untuk laporan
    Route::get('reports', [ReportController::class, 'index']);
});

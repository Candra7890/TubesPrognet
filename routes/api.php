<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function(){
    Route::post('admin', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('logout', [UserController::class, 'logout']);
});

Route::group([
    'middleware' => 'api'
], function(){
    Route::resources([
        'barangs' => BarangController::class,
        'satuanbarangs' => SatuanBarangController::class,
        'penjualans' => PenjualanController::class,
        'detailpenjualans' => DetailPenjualanController::class,
        'members' => MemberController::class,
        'testimonis' => TestimoniController::class,
        'sliders' => SliderController::class,
        'reviews' => ReviewController::class,
        'members' => MemberController::class,
        'categories' => CategoryController::class,
        'subcategories' => SubCategoryController::class,
        'pesanans' => PesananController::class,
        'laporans' => LaporanController::class,
        'pembayarans' => PembayaranController::class,
    ]);

    Route::get('pesanan/masuk', [PesananController::class, 'masuk']);
    Route::get('pesanan/dikonfirmasi', [PesananController::class, 'dikonfirmasi']);
    Route::get('pesanan/dikemas', [PesananController::class, 'dikemas']);
    Route::get('pesanan/dikirim', [PesananController::class, 'dikirim']);
    Route::get('pesanan/diterima', [PesananController::class, 'diterima']);
    Route::get('pesanan/selesai', [PesananController::class, 'selesai']);
    
    Route::post('pesanan/ubah_status/{pesanan}', [PesananController::class, 'ubah_status']);

    Route::get('laporans', [LaporanController::class, 'get_laporans']);
});


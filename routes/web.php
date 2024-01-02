<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\HomepageController;

// auth
Route::get('login', [UserController::class, 'index'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout']);


Route::get('login_member', [UserController::class, 'login_member']);
Route::post('login_member', [UserController::class, 'login_member_action']);
Route::get('logout_member', [UserController::class, 'logout_member']);


Route::get('register_member', [UserController::class, 'register_member']);
Route::post('register_member', [UserController::class, 'register_member_action']);

// kategori
Route::get('/kategori', [CategoryController::class, 'list']);

// subkategori
Route::get('/subkategori', [SubCategoryController::class, 'list']);

// slider
Route::get('/slider', [SliderController::class, 'list']);

// barang
Route::get('/barang', [BarangController::class, 'list']);


// testimoni
Route::get('/testimoni', [TestimoniController::class, 'list']);

// satuan barang
Route::get('/satuanbarang', [SatuanBarangController::class, 'list']);

// pesanan
Route::get('/pesanan/masuk', [PesananController::class, 'list']);
Route::get('/pesanan/dikonfirmasi', [PesananController::class, 'dikonfirmasi_list']);
Route::get('/pesanan/dikemas', [PesananController::class, 'dikemas_list']);
Route::get('/pesanan/dikirim', [PesananController::class, 'dikirim_list']);
Route::get('/pesanan/diterima', [PesananController::class, 'diterima_list']);
Route::get('/pesanan/selesai', [PesananController::class, 'selesai_list']);

// laporan
Route::get('/laporan', [LaporanController::class, 'index']);

// penjualan
Route::get('/penjualan', [PenjualanController::class, 'list']);

// detailpenjualan
Route::get('/detailpenjualan', [DetailPenjualanController::class, 'list']);

// pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'list']);

// tentang
Route::get('/tentang', [TentangController::class, 'index']);
Route::post('/tentang/{about}', [TentangController::class, 'update']);


// homepage
Route::get('/', [HomepageController::class, 'index']);
Route::get('/barangs/{category}', [HomepageController::class, 'barangs']);
Route::get('/barang/{id}', [HomepageController::class, 'barang']);
Route::get('/keranjang', [HomepageController::class, 'keranjang']);
Route::get('/checkout', [HomepageController::class, 'checkout']);
Route::get('/pesanans', [HomepageController::class, 'pesanans']);
Route::get('/about', [HomepageController::class, 'about']);
Route::get('/contact', [HomepageController::class, 'contact']);
Route::get('/faq', [HomepageController::class, 'faq']);
Route::post('/add_to_keranjang', [HomepageController::class, 'add_to_keranjang']);
Route::get('/delete_from_keranjang/{keranjang}', [HomepageController::class, 'delete_from_keranjang']);
Route::get('/get_kota/{id}', [HomepageController::class, 'get_kota']);
Route::get('/get_ongkir/{destination}/{weight}', [HomepageController::class, 'get_ongkir']);
Route::post('/checkout_pesanans', [HomepageController::class, 'checkout_pesanans']);
Route::post('/pembayarans', [HomepageController::class, 'pembayarans']);
Route::post('/pesanan_selesai/{pesanan}', [HomepageController::class, 'pesanan_selesai']);

Route::get('/dashboard', [DashboardController::class, 'index']);


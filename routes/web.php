<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\KasirAkunController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrPesananController;
use App\Http\Controllers\KasirPesananController;
use App\Http\Controllers\StokController;
use Illuminate\Support\Facades\Route;

// Health check endpoint for Railway
Route::get('/health', function () {
    return response('OK', 200);
});

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->to(auth()->user()->homeRoute());
    }

    return redirect()->route('login');
})->name('splash');

Route::prefix('pesan')->name('pesan.')->group(function () {
    Route::get('/', [PesananUserController::class, 'index'])->name('index');
    Route::get('/menu', [PesananUserController::class, 'index'])->name('menu');
    Route::get('/cari', [PesananUserController::class, 'search'])->name('search');
    Route::post('/', [PesananUserController::class, 'store'])->name('store');
    Route::get('/sukses/{pesanan}', [PesananUserController::class, 'sukses'])->name('sukses');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('produk', ProdukController::class)->except(['show']);

    Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
    Route::post('/stok', [StokController::class, 'store'])->name('stok.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{transaksi}', [LaporanController::class, 'show'])->name('laporan.show');

    Route::get('/grafik', [GrafikController::class, 'index'])->name('grafik.index');

    Route::get('/qr-pesanan', [QrPesananController::class, 'index'])->name('qr-pesanan.index');

    Route::get('/akun-kasir', [KasirAkunController::class, 'index'])->name('akun-kasir.index');
    Route::get('/akun-kasir/create', [KasirAkunController::class, 'create'])->name('akun-kasir.create');
    Route::post('/akun-kasir', [KasirAkunController::class, 'store'])->name('akun-kasir.store');
    Route::get('/akun-kasir/{user}/edit', [KasirAkunController::class, 'edit'])->name('akun-kasir.edit');
    Route::put('/akun-kasir/{user}', [KasirAkunController::class, 'update'])->name('akun-kasir.update');
    Route::get('/akun-kasir/{user}/reset-password', [KasirAkunController::class, 'showResetPassword'])->name('akun-kasir.reset-password');
    Route::put('/akun-kasir/{user}/reset-password', [KasirAkunController::class, 'resetPassword'])->name('akun-kasir.reset-password.update');
    Route::delete('/akun-kasir/{user}', [KasirAkunController::class, 'destroy'])->name('akun-kasir.destroy');
});

Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/', [KasirController::class, 'index'])->name('index');
    Route::get('/cari', [KasirController::class, 'search'])->name('search');
    Route::post('/checkout', [KasirController::class, 'checkout'])->name('checkout');
    Route::get('/struk/{transaksi}', [KasirController::class, 'struk'])->name('struk');

    Route::get('/pesanan', [KasirPesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}/bayar', [KasirPesananController::class, 'bayar'])->name('pesanan.bayar');
    Route::post('/pesanan/{pesanan}/bayar', [KasirPesananController::class, 'checkout'])->name('pesanan.checkout');
    Route::post('/pesanan/{pesanan}/batalkan', [KasirPesananController::class, 'batalkan'])->name('pesanan.batalkan');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

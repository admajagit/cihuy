<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\TransaksiController;

// Halaman utama untuk daftar kendaraan
Route::get('/', [KendaraanController::class, 'index'])->name('kendaraanku.index');

// Form untuk membuat transaksi baru
// routes/web.php
Route::get('/transaksi/create/{kendaraan_id}', [TransaksiController::class, 'create'])->name('transaksi.create');
// Proses penyimpanan transaksi
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Welcome
Route::get('/', function () {
    return view('dashboard');
});
Auth::routes();
Route::get('/pesan', [App\Http\Controllers\InputController::class, 'pesan'])->name('pesan');
Route::get('/resi_dp', [App\Http\Controllers\InputController::class, 'resi_dp'])->name('resi_dp');
Route::get('/upload_bukti_dp', [App\Http\Controllers\InputController::class, 'upload_bukti_dp'])->name('upload_bukti_dp');
Route::get('/turnamen', [App\Http\Controllers\HomeController::class, 'turnamen'])->name('turnamen');

//HOME
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::post('/inputinventory', [App\Http\Controllers\HomeController::class, 'store_inventory'])->name('store_inventory');
Route::get('/inventory/delete/{id_inventory}', [App\Http\Controllers\HomeController::class, 'destroy_inventory'])->name('destroy_inventory');

// VERIFIKASI
Route::get('/verifikasi_pelunasan', [App\Http\Controllers\VerifikasiController::class, 'verifikasi_pelunasan'])->name('verifikasi_pelunasan');
Route::get('/verifikasi_member_baru', [App\Http\Controllers\VerifikasiController::class, 'verifikasi_member_baru'])->name('verifikasi_member_baru');
Route::get('/laporan_keuangan_futsal', [App\Http\Controllers\LaporanController::class, 'laporan_keuangan_futsal'])->name('laporan_keuangan_futsal');

// TURNAMEN
Route::get('/buat_jadwal_turnamen', [App\Http\Controllers\TurnamenController::class, 'buat_jadwal_turnamen'])->name('buat_jadwal_turnamen');
Route::get('/validasi_turnamen', [App\Http\Controllers\TurnamenController::class, 'validasi_turnamen'])->name('validasi_turnamen');

// LAPORAN
Route::get('/laporan_keuangan_snack', [App\Http\Controllers\LaporanController::class, 'laporan_keuangan_snack'])->name('laporan_keuangan_snack');
Route::get('/laporan_keuangan_turnamen', [App\Http\Controllers\LaporanController::class, 'laporan_keuangan_turnamen'])->name('laporan_keuangan_turnamen');
Route::get('/laporan_keuangan_member', [App\Http\Controllers\LaporanController::class, 'laporan_keuangan_member'])->name('laporan_keuangan_member');

// SNACK
Route::get('/stock_snack', [App\Http\Controllers\SnackController::class, 'index'])->name('index');
Route::post('/inputstock', [App\Http\Controllers\SnackController::class, 'store_snack'])->name('store_snack');
Route::get('/snack/delete/{id_snack}', [App\Http\Controllers\SnackController::class, 'destroy_snack'])->name('destroy_snack');


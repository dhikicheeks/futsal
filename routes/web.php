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

//TODO HOME
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);

//TODO DASHOBORAD
Auth::routes();
Route::get('/pesan', [App\Http\Controllers\PesananController::class, 'index']);
Route::get('/resi_dp', [App\Http\Controllers\DashboardController::class, 'resi_dp'])->name('resi_dp');
Route::get('/upload_bukti_dp', [App\Http\Controllers\DashboardController::class, 'upload_bukti_dp'])->name('upload_bukti_dp');

//TODO MENYIMPAN PESANAN & RESI 
Route::post('/inputpesanan', [App\Http\Controllers\PesananController::class, 'store_pesanan']);
Route::post('/resi_transaksi_upload', [App\Http\Controllers\PesananController::class, 'resi_transaksi_upload']);


//! MENU MEMBUTUHKAN AUTH
Route::group( ['middleware' => ['auth']], function() {

//*HOME ADMIN & OWNER & MEMBER
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

//TODO DETAIL MODAL
Route::post('detail_validasi_dp', [App\Http\Controllers\VerifikasiController::class, 'detail_validasi_dp']);
Route::post('detail_validasi_pelunasan', [App\Http\Controllers\VerifikasiController::class, 'detail_validasi_pelunasan']);
Route::post('detail_keuangan_futsal', [App\Http\Controllers\LaporanController::class, 'detail_keuangan_futsal']);

//TODO UPDATE STATUS
Route::post('/update_verifikasi_dp', [App\Http\Controllers\VerifikasiController::class, 'update_verifikasi_dp']);
Route::post('/update_verifikasi_pelunasan', [App\Http\Controllers\VerifikasiController::class, 'update_verifikasi_pelunasan']);

//TODO INVENTORY (CRUD)
Route::post('/inputinventory', [App\Http\Controllers\HomeController::class, 'store_inventory'])->name('store_inventory');
Route::get('/inventory/delete/{id_inventory}', [App\Http\Controllers\HomeController::class, 'destroy_inventory'])->name('destroy_inventory');
Route::post('edit_inventory', [App\Http\Controllers\HomeController::class, 'edit_inventory']);
Route::post('/update-inventory', [App\Http\Controllers\HomeController::class, 'update_inventory']);

//TODO SNACK (CRUD)
Route::get('/stock_snack', [App\Http\Controllers\SnackController::class, 'index'])->name('index');
Route::post('/inputstock', [App\Http\Controllers\SnackController::class, 'store_snack'])->name('store_snack');
Route::get('/snack/delete/{id_snack}', [App\Http\Controllers\SnackController::class, 'destroy_snack'])->name('destroy_snack');

//TODO VERIFIKASI VIEW
Route::get('/verifikasi_pelunasan', [App\Http\Controllers\VerifikasiController::class, 'verifikasi_pelunasan'])->name('verifikasi_pelunasan');
Route::get('/verifikasi_member_baru', [App\Http\Controllers\VerifikasiController::class, 'verifikasi_member_baru'])->name('verifikasi_member_baru');
Route::get('/laporan_keuangan_futsal', [App\Http\Controllers\LaporanController::class, 'laporan_keuangan_futsal'])->name('laporan_keuangan_futsal');

//TODO LAPORAN KEUANGAN VIEW
Route::get('/laporan_keuangan_snack', [App\Http\Controllers\LaporanController::class, 'laporan_keuangan_snack'])->name('laporan_keuangan_snack');
Route::get('/laporan_keuangan_turnamen', [App\Http\Controllers\LaporanController::class, 'laporan_keuangan_turnamen'])->name('laporan_keuangan_turnamen');
Route::get('/laporan_keuangan_member', [App\Http\Controllers\LaporanController::class, 'laporan_keuangan_member'])->name('laporan_keuangan_member');

});
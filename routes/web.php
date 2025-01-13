<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelolaPengguna;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\UserAccess;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login-proses', [AuthController::class, 'cekLogin'])->name('login-proses');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda')->middleware('UserAccess:super_admin,super_owner,admin,kasir,owner');
    // Route::get('/super-admin-beranda', [SuperController::class, 'index'])->name('superadminberanda')->middleware('UserAccess:super_admin,super_owner');

    Route::prefix('data-outlet')->middleware('UserAccess:super_admin,admin')->group(function () {
        Route::get('/', [OutletController::class, 'index'])->name('outlet');
        Route::resource('/outlet', OutletController::class);
        Route::put('/{FADHIL_id}', [OutletController::class, 'update'])->name('outlet.update');
        Route::delete('/{FADHIL_id}', [OutletController::class, 'destroy'])->name('outlet.destroy');
    });

    Route::prefix('data-paket')->middleware('UserAccess:super_admin,admin')->group(function () {
        Route::get('/', [PaketController::class, 'index'])->name('paket');
        Route::resource('/paket', PaketController::class);
        Route::put('/{FADHIL_id}', [PaketController::class, 'update'])->name('paket.update');
        Route::delete('/{FADHIL_id}', [PaketController::class, 'destroy'])->name('paket.destroy');
    });

    Route::prefix('data-pengguna')->middleware('UserAccess:super_admin,admin')->group(function () {
        Route::get('/', [KelolaPengguna::class, 'index'])->name('kelolapengguna');
        Route::resource('/pengguna', KelolaPengguna::class);
        Route::put('/{FADHIL_id}', [KelolaPengguna::class, 'update'])->name('pengguna.update');
        Route::delete('/{FADHIL_id}', [KelolaPengguna::class, 'destroy'])->name('pengguna.destroy');
    });

    Route::prefix('data-member')->middleware('UserAccess:super_admin,admin,kasir')->group(function () {
        Route::get('/', [MemberController::class, 'index'])->name('member');
        Route::resource('/member', MemberController::class);
        Route::put('/{FADHIL_id}', [MemberController::class, 'update'])->name('member.update');
        Route::delete('/{FADHIL_id}', [MemberController::class, 'destroy'])->name('member.destroy');
    });

    Route::get('/transaksi',     [TransaksiController::class, 'index'])->name('transaksi')->middleware('UserAccess:super_admin,admin,kasir');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store')->middleware('UserAccess:super_admin,admin,kasir');
    // Route::get('/transaksi/reset', [TransaksiController::class, 'reset'])->name('transaksi.reset')->middleware('UserAccess:super_admin,admin,kasir');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan')->middleware('UserAccess:super_admin,super_owner,admin,kasir,owner');
    Route::get('/laporan/faktur/{FADHIL_id}', [LaporanController::class, 'laporanFaktur'])->name('laporan.faktur')->middleware('UserAccess:super_admin,super_owner,admin,kasir,owner');
    Route::get('/laporan/detail/{FADHIL_id}', [LaporanController::class, 'laporanDetail'])->name('laporan.detail')->middleware('UserAccess:super_admin,super_owner,admin,kasir,owner');
    Route::get('/laporanfilter', [LaporanController::class, 'laporanFilter'])->name('laporan.filter')->middleware('UserAccess:super_admin,super_owner,admin,kasir,owner');
    Route::put('/laporan/bayar{FADHIL_id}', [LaporanController::class, 'update'])->name('laporan.update')->middleware('UserAccess:super_admin,admin,kasir');
    Route::put('/laporan/status{FADHIL_id}', [LaporanController::class, 'laporanStatus'])->name('laporan.status')->middleware('UserAccess:super_admin,admin,kasir');
    Route::get('/laporan-show', [LaporanController::class, 'laporanShow'])->name('laporan.show')->middleware('UserAccess:super_admin,super_owner,admin,kasir,owner');
    Route::get('/laporan-exportpdf', [LaporanController::class, 'laporanEksporPDF'])->name('laporan.eksporPDF')->middleware('UserAccess:super_admin,super_owner,admin,kasir,owner');
    Route::get('/laporan-exportxls', [LaporanController::class, 'laporanEksporXLS'])->name('laporan.eksporXLS')->middleware('UserAccess:super_admin,super_owner,admin,kasir,owner');

    Route::get('/log', [LogController::class, 'index'])->name('log')->middleware('UserAccess:super_admin,admin');
    Route::get('/laporanlogfilter', [LogController::class, 'laporanLogFilter'])->name('laporanLog.filter')->middleware('UserAccess:super_admin,admin');
    Route::get('/laporanlog-show', [LogController::class, 'laporanLogShow'])->name('laporanLog.show')->middleware('UserAccess:super_admin,admin');
    Route::get('/laporanlog-exportpdf', [LogController::class, 'laporanLogEksporPDF'])->name('laporanLog.eksporPDF')->middleware('UserAccess:super_admin,admin');
    Route::get('/laporanlog-exportxls', [LogController::class, 'laporanLogEksporXLS'])->name('laporanLog.eksporXLS')->middleware('UserAccess:super_admin,admin');

    Route::get('/cetak-struk/{FADHIL_id}', [TransaksiController::class, 'cetakStruk'])->name('cetakStruk')->middleware('UserAccess:super_admin,admin,kasir');
    Route::get('/laporanRedirect', [TransaksiController::class, 'laporanRedirect'])->name('laporanRedirect')->middleware('UserAccess:super_admin,admin,kasir');
});

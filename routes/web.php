<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LaporanWordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExcelExportController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\PDFController;

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

Route::get('/admin', function () {
    return redirect()->route('admin.index');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', function () {
    return redirect()->route('admin.index');
})->name('home');

Route::prefix('/admin')->group(function () {
    Route::controller(ImpersonateController::class)->group(function () {
        Route::middleware(['auth', 'user-access:SuperAdmin,Admin'])->group(function () {
            Route::get('impersonate/{user}', 'impersonate')->name('admin.impersonate');
        });
        Route::get('stop-impersonating', 'stopImpersonating')->name('admin.stop-impersonating');
    });
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin.index');
        Route::get('/pengguna', 'pengguna')->name('admin.pengguna');
        Route::get('/kategori', 'kategori')->name('admin.kategori');
        Route::get('/menu-laporan', 'menulaporan')->name('admin.menulaporan');
        Route::get('/daftar-pengaduan/{tentang}', 'daftarpengaduan')->name('admin.daftarpengaduan');
        Route::get('/tindak-lanjut/{id}', 'tindaklanjut')->name('admin.tindaklanjut');
    });
    Route::controller(LaporanWordController::class)->group(function () {
        Route::prefix('msword')->group(function () {
            // Route::get('/laporan-tinjut', 'LaporanTinjut')->name('laporan-tinjut');
            // Route::get('/laporan-monev', 'LaporanMonev')->name('laporan-monev');
            Route::get('/laporan-pengaduan', 'LaporanPengaduanM')->name('laporan-pengaduan-masyarakat');
        });
    });
    Route::controller(PDFController::class)->group(function () {
        Route::get('/laporan-pengaduan', 'aduan')->name('laporan-pengaduan');
    });
    Route::controller(ExcelExportController::class)->group(function () {
        Route::get('/export-pengaduan', 'exportpengaduan')->name('export-pengaduan');
    });
});

Route::controller(Controller::class)->group(function () {
    Route::get('/', 'index')->name('main.index');
    Route::get('/laporan', 'laporan')->name('main.laporan');
});

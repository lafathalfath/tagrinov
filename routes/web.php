<?php

use App\Http\Controllers\EntitasController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\Guest\TanamanController;
use App\Http\Controllers\Guest\TestimoniController;
use App\Http\Controllers\Guest\FeedbackController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\PermohonanController;
use App\Http\Controllers\Guest\StokBenihController;
use App\Http\Controllers\Guest\QrcodeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KategoriController;
use App\Http\Guest\Controllers\EventController;
use Illuminate\Support\Facades\Route;

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

// guest start
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/stokbenih', [StokBenihController::class, 'index'])->name('stokBenih.index');
Route::get('/stokbenih/{id}/detail', [StokBenihController::class, 'detail'])->name('stokBenih.detail');

Route::get('/kunjungan', [PermohonanController::class, 'kunjungan'])->name('permohonan.kunjungan.index');

Route::get('/benih', [PermohonanController::class, 'benih'])->name('permohonan.benih.index');

Route::get('tanaman/qrcode', [QrcodeController::class, 'qrcode'])->name('tanaman.qrcode');

Route::prefix('/testimoni')->group(function () {
    Route::get('/', [FeedbackController::class, 'index'])->name('testimoni.index');
    Route::post('/', [FeedbackController::class, 'store'])->name('testimoni.store');
});

Route::prefix('/tanaman')->group(function () {
    Route::get('/', [TanamanController::class, 'index'])->name('tanaman.index');
    Route::get('/{id}/detail', [TanamanController::class, 'detail'])->name('tanaman.detail');
    Route::get('/qr/generate', [TanamanController::class, 'generateQrAll'])->name('tanaman.generate.qr');
    Route::get('/qr/view', [TanamanController::class, 'viewQr']);
});

<<<<<<< HEAD


Route::get('/kunjungan', function () {
    return view('guest.permohonan.kunjungan.kunjungan');
});

Route::get('/benih', function () {
    return view('guest.permohonan.benih.benih');
});


// Route::get('/kunjungan', [KunjunganController::class, 'index']);
// Route::post('/kunjungan', [KunjunganController::class, 'store']);

Route::get('/testimoni/create', [FeedbackController::class, 'create']);
Route::post('/testimoni', [FeedbackController::class, 'store']);


Route::get('/tanaman', [TanamanController::class, 'index'])->name('tanaman.index');
Route::get('/tanaman/{id}/detail', [TanamanController::class, 'detail'])->name('tanaman.detail');
Route::get('/tanaman/qr/generate', [TanamanController::class, 'generateQrAll'])->name('tanaman.generate.qr');
Route::get('/tanaman/qr/view', [TanamanController::class, 'viewQr'])->name('tanaman.view.qr');
// Route::get('/tanaman/detail', [TanamanController::class, 'detail'])->name('tanaman.detail');

=======
>>>>>>> d5f88884c833fe28761238575012adaab67ee7af
Route::get('/events', [EventController::class, 'index']);
// guest end


// admin start
Route::prefix('/admin')->group(function () {
    Route::prefix('/family')->group(function () {
        Route::get('/', [FamilyController::class, 'getAll'])->name('family.getAll');
        Route::get('/{id}', [FamilyController::class, 'getById'])->name('family.getById');
        Route::post('/', [FamilyController::class, 'store'])->name('family.store');
        Route::put('/{id}', [FamilyController::class, 'update'])->name('family.update');
        Route::delete('/{id}', [FamilyController::class, 'destroy'])->name('family.destroy');
    });
    
    Route::prefix('/jenis')->group(function () {
        Route::get('/', [JenisController::class, 'getAll'])->name('jenis.getAll');
        Route::get('/{id}', [JenisController::class, 'getById'])->name('jenis.getById');
        Route::post('/', [JenisController::class, 'store'])->name('jenis.store');
        Route::put('/{id}', [JenisController::class, 'update'])->name('jenis.update');
        Route::delete('/{id}', [JenisController::class, 'destroy'])->name('jenis.destroy');
    });
    
    Route::prefix('/kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'getAll'])->name('kategori.getAll');
        Route::get('/{id}', [KategoriController::class, 'getById'])->name('kategori.getById');
        Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });
    
    Route::prefix('/entitas')->group(function () {
        Route::get('/', [EntitasController::class, 'getAll'])->name('entitas.getAll');
        Route::get('/{id}', [EntitasController::class, 'getById'])->name('entitas.getById');
        Route::post('/', [EntitasController::class, 'store'])->name('entitas.store');
        Route::put('/{id}', [EntitasController::class, 'update'])->name('entitas.update');
        Route::delete('/{id}', [EntitasController::class, 'destroy'])->name('entitas.destroy');
    });
});

// admin end
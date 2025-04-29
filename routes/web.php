<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TestimoniAdminController;
use App\Http\Controllers\Admin\WelcomeTextController;
use App\Http\Controllers\Admin\BenihController;
use App\Http\Controllers\ManageAccountController;
use App\Http\Controllers\TimKerjaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\EntitasController;
use App\Http\Controllers\EntitasDetailController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\Guest\TanamanController;
use App\Http\Controllers\Guest\FeedbackController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\PermohonanController;
use App\Http\Controllers\StokBenihController;
use App\Http\Controllers\Guest\QrcodeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\EventController;
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

//permohonan
// Route::get('/kunjungan', [PermohonanController::class, 'kunjungan'])->name('permohonan.kunjungan.index');
// Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');

// Route::get('/benih', [PermohonanController::class, 'benih'])->name('permohonan.benih.index');

Route::get('tanaman/qrcode', [QrcodeController::class, 'qrcode'])->name('tanaman.qrcode');

Route::prefix('/testimoni')->group(function () {
    Route::get('/', [FeedbackController::class, 'index'])->name('testimoni.index');
    Route::post('/', [FeedbackController::class, 'store'])->name('testimoni.store');
});

Route::prefix('/tanaman')->group(function () {
    Route::get('/', [TanamanController::class, 'index'])->name('tanaman.index');
    Route::get('/{id}/detail', [TanamanController::class, 'detail'])->name('tanaman.detail');
    Route::get('/qr/generate', [TanamanController::class, 'generateQrAll'])->name('tanaman.generate.qr');
});

Route::prefix('/stokbenih')->group(function () {
    Route::get('/', [StokBenihController::class, 'index'])->name('stokbenih.index');
    Route::get('/detail/{id}', [StokBenihController::class, 'detail'])->name('stokbenih.detail');
});

Route::prefix('/kunjungan')->group(function () {
    Route::get('/', [KunjunganController::class, 'index'])->name('guest.permohonan.kunjungan.index');
    Route::post('/', [KunjunganController::class, 'store'])->name('kunjungan.store');
});

Route::get('/benih', function () {
    return view('guest.permohonan.benih.benih');
});

Route::get('/tanaman', [TanamanController::class, 'index'])->name('tanaman.index');
Route::get('/tanaman/{id}/detail', [TanamanController::class, 'detail'])->name('tanaman.detail');
Route::get('/tanaman/qr/generate', [TanamanController::class, 'generateQrAll'])->name('tanaman.generate.qr');
Route::get('/tanaman/qr/view', [TanamanController::class, 'viewQr'])->name('tanaman.view.qr');
// Route::get('/tanaman/detail', [TanamanController::class, 'detail'])->name('tanaman.detail');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
// guest end

// login route
Route::view('/login', 'auth.login')->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// tim kerja start
Route::middleware(['timkerja'])->prefix('/timkerja')->group(function () {
    Route::get('/', [TimKerjaController::class, 'dashboard'])->name('timkerja.dashboard');

    Route::prefix('/kunjungan')->group(function () {
        Route::get('/', [KunjunganController::class, 'indextimkerja'])->name('timkerja.kunjungan.index');
        Route::get('/undangan/{id}', [KunjunganController::class, 'unduhUndangan'])->name('kunjungan.undangan');
        Route::get('/{id}', [KunjunganController::class, 'detail'])->name('kunjungan.detail');
        Route::post('/{id}/approve', [KunjunganController::class, 'approve'])->name('kunjungan.approve');
        Route::post('/{id}/reject', [KunjunganController::class, 'reject'])->name('kunjungan.reject');
        Route::put('/{id}/cancelapproval', [KunjunganController::class, 'cancelApproval'])->name('kunjungan.cancelApproval');
        Route::put('/{id}/cancelrejection', [KunjunganController::class, 'cancelRejectionApproval'])->name('kunjungan.cancelRejectionApproval');
        Route::delete('/{id}', [KunjunganController::class, 'destroykunjungan'])->name('kunjungan.destroy');
    });
});

// auth role
Route::middleware(['auth', 'role:admin,tim_kerja'])->group(function () { 
    Route::get('/export-xlsx', [KunjunganController::class, 'exportxlsx'])->name('kunjungan.exportxlsx');
    Route::get('/export-pdf', [KunjunganController::class, 'exportPDF'])->name('kunjungan.exportpdf'); 

    Route::prefix('/kelola-akun')->group(function () {
        Route::get('/', [ManageAccountController::class, 'index'])->name('kelola-akun.index');
        Route::post('/store', [ManageAccountController::class, 'store'])->name('kelola-akun.store');
        Route::post('/update-password', [ManageAccountController::class, 'updatePassword'])->name('kelola-akun.updatePassword');
        Route::post('/update-profile', [ManageAccountController::class, 'updateProfile'])->name('kelola-akun.updateProfile');
        Route::post('/delete/{id}', [ManageAccountController::class, 'destroy'])->name('kelola-akun.destroy'); 
    });
});

// admin start
Route::middleware(['admin'])->prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('slide_edit', [WelcomeTextController::class, 'edit'])->name('admin.welcome.edit');
    Route::post('slide_edit/{id}', [WelcomeTextController::class, 'update'])->name('admin.welcome.update');
    Route::get('/main/footer', [FooterController::class, 'edit'])->name('footer.edit');
    Route::put('/main/footer', [FooterController::class, 'update'])->name('footer.update');

    Route::prefix('/kunjungan')->group(function () {
        Route::get('/', [KunjunganController::class, 'getAll'])->name('kunjungan.getAll');
        Route::get('/trash', [KunjunganController::class, 'trash'])->name('kunjungan.trash');
        Route::get('/{id}', [KunjunganController::class, 'getById'])->name('kunjungan.getById');
        Route::delete('/{id}', [KunjunganController::class, 'destroy'])->name('kunjungan.destroy');
        Route::post('/verify/{id}', [KunjunganController::class, 'verify'])->name('kunjungan.verify');
        Route::put('/{id}/reject', [KunjunganController::class, 'rejectVerification'])->name('kunjungan.rejectVerification');
        Route::get('/kunjungan/{id}/cancel', [KunjunganController::class, 'cancelVerification'])->name('kunjungan.cancelVerification');
        Route::put('{id}/cancel-rejection', [KunjunganController::class, 'cancelRejection'])->name('kunjungan.cancelRejection');
        Route::post('/restore/{id}', [KunjunganController::class, 'restore'])->name('kunjungan.restore');
        Route::delete('/force-delete/{id}', [KunjunganController::class, 'forceDelete'])->name('kunjungan.forceDelete');

    });

    Route::prefix('/testimoni')->name('admin.testimoni.')->group(function () {
        Route::get('/', [TestimoniAdminController::class, 'index'])->name('index');
        Route::get('/{id}/detail', [TestimoniAdminController::class, 'detail'])->name('detail'); 
        Route::get('/{id}/approve', [TestimoniAdminController::class, 'approve'])->name('approve'); 
        Route::get('/{id}/reject', [TestimoniAdminController::class, 'reject'])->name('reject');
        Route::delete('/{id}', [TestimoniAdminController::class, 'destroy'])->name('destroy');
    });

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
        Route::get('/{id}/qrcode', [EntitasController::class, 'generateQrCode'])->name('entitas.qrcode');
        // Route for EntitasDetail
        Route::prefix('/detail')->group(function () {
            Route::get('/{id}', [EntitasDetailController::class, 'getById'])->name('entitas.detail.getById');
            Route::put('/{id}', [EntitasDetailController::class, 'update'])->name('entitas.detail.update');
        });
    });

    // Route::prefix('/kelola-akun')->group(function () {
    //     Route::get('/', [ManageAccountController::class, 'index'])->name('kelola-akun.index');
    //     Route::post('/add', [ManageAccountController::class, 'store'])->name('kelola-akun.store');
    //     Route::put('/updateprofile', [ManageAccountController::class, 'updateProfile'])->name('kelola-akun.updateProfile');
    //     Route::put('/updatepassword', [ManageAccountController::class, 'updatePassword'])->name('kelola-akun.updatePassword');
    //     Route::delete('/{id}', [ManageAccountController::class, 'destroy'])->name('kelola-akun.destroy');
    // });

    Route::prefix('/benih')->group(function () {
        Route::get('/', [BenihController::class, 'getAll'])->name('benih.getAll');
        Route::get('/{id}', [BenihController::class, 'getById'])->name('benih.getById');
        Route::post('/', [BenihController::class, 'store'])->name('benih.store');
        Route::put('/{id}', [BenihController::class, 'update'])->name('benih.update');
        Route::delete('/{id}', [BenihController::class, 'destroy'])->name('benih.destroy');
    });
});
// admin end


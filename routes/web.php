<?php

use App\Http\Controllers\EntitasController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KategoriController;
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

Route::get('/', function () {
    return view('welcome');
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
});
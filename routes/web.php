<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriFormatController;
use App\Http\Controllers\KoleksiPitaController;
use App\Http\Controllers\TindakanRestorasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SK04 Restorasi Pita Analog
|--------------------------------------------------------------------------
*/

// Dashboard Utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// CRUD Koleksi Pita (dengan Detail Kondisi & Pivot Tindakan)
Route::resource('koleksi', KoleksiPitaController::class);

// CRUD Master Kategori Format
Route::resource('kategori', KategoriFormatController::class);

// CRUD Master Tindakan Restorasi
Route::resource('tindakan', TindakanRestorasiController::class);

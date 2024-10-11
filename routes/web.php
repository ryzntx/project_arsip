<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArsipKeluarController;
use App\Http\Controllers\ArsipMasukController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TambahDokumenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->intended();
    }
    return view('auth.login');
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile/edit/ubahPassword', [ProfileController::class, 'update'])->name('profile.update');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/admin/kelola_user', [AdminController::class, 'kelola_user'])->name('admin.user.kelola_user');
    Route::get('/admin/kelola_user/add', [AdminController::class, 'add_user'])->name('admin.user.add_user');
    Route::post('/admin/kelola_user/insert', [AdminController::class, 'insert_user']);
    Route::get('/admin/kelola_user/delete/{id}', [AdminController::class, 'delete_user']);

    Route::get('/admin/kelola_instansi', [InstansiController::class , 'kelola_instansi'])->name('admin.kelola_instansi');
    Route::get('/admin/kelola_instansi/add', [InstansiController::class, 'add_instansi'])->name('admin.kelola_instansi.add');
    Route::post('/admin/kelola_instansi/insert', [InstansiController::class, 'insert_instansi'])->name('admin.kelola_instansi.insert');
    Route::get('/admin/kelola_instansi/edit/{id}', [InstansiController::class , 'edit_instansi'])->name('admin.kelola_instansi.edit');
    Route::put('/admin/kelola_instansi/update/{id}', [InstansiController::class , 'update_instansi'])->name('admin.kelola_instansi.update');
    Route::get('/admin/kelola_instansi/delete/{id}', [InstansiController::class , 'delete_instansi'])->name('admin.kelola_instansi.delete');


    Route::get('/admin/kelola_kategori', [KategoriController::class , 'kelola_kategori'])->name('admin.kelola_kategori');
    Route::get('/admin/kelola_kategori/add', [KategoriController::class, 'add_kategori'])->name('admin.kelola_kategori.add');
    Route::post('/admin/kelola_kategori/insert', [KategoriController::class, 'insert_kategori'])->name('admin.kelola_kategori.insert');
    Route::get('/admin/kelola_kategori/edit/{id}', [kategoriController::class , 'edit_kategori'])->name('admin.kelola_kategori.edit');
    Route::put('/admin/kelola_kategori/update/{id}', [kategoriController::class , 'update_kategori'])->name('admin.kelola_kategori.update');
    Route::get('/admin/kelola_kategori/delete/{id}', [KategoriController::class , 'delete_kategori'])->name('admin.kelola_kategori.delete');


    Route::get('/admin/tambah_dokumen', [TambahDokumenController::class, 'tambah_dokumen'])->name('admin.tambah_dokumen');
    Route::post('/admin/tambah_dokumen/insert', [TambahDokumenController::class, 'store'])->name('admin.store');

    // Route::get('/admin/tambah_dokumen/insert', [AdminController::class, 'store'])->name('admin.store');

    Route::get('/admin/arsip_masuk', [ArsipMasukController::class, 'index'])->name('admin.arsip_masuk');

    Route::get('/admin/arsip_keluar', [ArsipKeluarController::class, 'index'])->name('admin.arsip_keluar');

    Route::get('/admin/rekap', [AdminController::class, 'rekap'])->name('admin.rekap_dokumen');

});

Route::middleware(['auth', 'role:pimpinan'])->group(function () {
    Route::get('/pimpinan/dashboard', [PimpinanController::class, 'dashboard'])->name('pimpinan.dashboard');
});

require __DIR__ . '/auth.php';

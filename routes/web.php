<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArsipKeluarController;
use App\Http\Controllers\ArsipMasukController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Pencarian;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapanArsipController;
use App\Http\Controllers\TambahDokumenController;
use App\Http\Controllers\TemplateDokumen;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    if (Auth::check()) {
        return redirect()->intended();
    }
    return view("auth.login");
})->middleware("guest");

Route::middleware("auth")->group(function () {
    Route::get("/profile/edit", [
        ProfileController::class,
        "ubah_profil",
    ])->name("profile.edit");
    // Route::patch('/profile/edit/ubahPassword', [ProfileController::class, 'update'])->name('profile.update');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch("/profile", [ProfileController::class, "update_profil"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "hapus_profil"])->name(
        "profile.destroy"
    );

    Route::get("pencarian", [Pencarian::class, "pencarian"])->name("pencarian");
    Route::get("pencarian/detail/{slug}", [
        Pencarian::class,
        "detail_pencarian",
    ])->name("pencarian.detail");
});

Route::middleware(["auth", "role:admin"])->group(function () {
    Route::get("/admin/dashboard", [AdminController::class, "dashboard"])->name(
        "dashboard"
    );

    Route::get("/admin/kelola_user", [
        UserController::class,
        "kelola_user",
    ])->name("admin.user.kelola_user");
    Route::get("/admin/kelola_user/add", [
        UserController::class,
        "add_user",
    ])->name("admin.user.add_user");
    Route::post("/admin/kelola_user/insert", [
        UserController::class,
        "insert_user",
    ]);
    Route::get("/admin/kelola_user/delete/{id}", [
        UserController::class,
        "delete_user",
    ]);

    Route::get("/admin/kelola_instansi", [
        InstansiController::class,
        "kelola_instansi",
    ])->name("admin.kelola_instansi");
    Route::get("/admin/kelola_instansi/add", [
        InstansiController::class,
        "add_instansi",
    ])->name("admin.kelola_instansi.add");
    Route::post("/admin/kelola_instansi/insert", [
        InstansiController::class,
        "insert_instansi",
    ])->name("admin.kelola_instansi.insert");
    Route::get("/admin/kelola_instansi/edit/{id}", [
        InstansiController::class,
        "edit_instansi",
    ])->name("admin.kelola_instansi.edit");
    Route::put("/admin/kelola_instansi/update/{id}", [
        InstansiController::class,
        "update_instansi",
    ])->name("admin.kelola_instansi.update");
    Route::get("/admin/kelola_instansi/delete/{id}", [
        InstansiController::class,
        "delete_instansi",
    ])->name("admin.kelola_instansi.delete");

    Route::get("/admin/kelola_kategori", [
        KategoriController::class,
        "kelola_kategori",
    ])->name("admin.kelola_kategori");
    Route::get("/admin/kelola_kategori/add", [
        KategoriController::class,
        "add_kategori",
    ])->name("admin.kelola_kategori.add");
    Route::post("/admin/kelola_kategori/insert", [
        KategoriController::class,
        "insert_kategori",
    ])->name("admin.kelola_kategori.insert");
    Route::get("/admin/kelola_kategori/edit/{id}", [
        KategoriController::class,
        "edit_kategori",
    ])->name("admin.kelola_kategori.edit");
    Route::put("/admin/kelola_kategori/update/{id}", [
        KategoriController::class,
        "update_kategori",
    ])->name("admin.kelola_kategori.update");
    Route::get("/admin/kelola_kategori/delete/{id}", [
        KategoriController::class,
        "delete_kategori",
    ])->name("admin.kelola_kategori.delete");

    Route::get("/admin/tambah_dokumen", [
        TambahDokumenController::class,
        "tambah_dokumen",
    ])->name("admin.tambah_dokumen");

    Route::get('/admin/tambah_dokumen/ambiltemplate/{id}', [TambahDokumenController::class, 'jsonGetDataDokTemplate'])->name('admin.ambil_template');

    Route::post("/admin/tambah_dokumen/insert", [
        TambahDokumenController::class,
        "simpan",
    ])->name("admin.simpan");

    Route::get("/admin/arsip_masuk", [
        ArsipMasukController::class,
        "kelola_arsip_masuk",
    ])->name("admin.kelola_arsipMasuk");
    Route::get("/admin/arsip_masuk/download/{path_pdf}", [
        ArsipMasukController::class,
        "download_arsip_masuk",
    ])->name("admin.kelola_arsipMasuk");
    Route::get("/admin/arsip_masuk/edit/{id}", [
        ArsipMasukController::class,
        "edit_arsipMasuk",
    ])->name("admin.kelola_arsipMasuk.edit");
    Route::put("/admin/arsip_masuk/update/{id}", [
        ArsipMasukController::class,
        "update_arsipMasuk",
    ])->name("admin.kelola_arsipMasuk.update");

    Route::get("/admin/arsip_keluar", [
        ArsipKeluarController::class,
        "kelola_arsip_keluar",
    ])->name("admin.kelola_arsipKeluar");
    Route::get("/admin/arsip_keluar/print/{id}", [
        ArsipKeluarController::class,
        "print",
    ])->name("admin.kelola_arsipKeluar.print");
    Route::get("/admin/arsip_keluar/edit/{id}", [
        ArsipKeluarController::class,
        "edit_arsipKeluar",
    ])->name("admin.kelola_arsipKeluar.edit");
    Route::put("/admin/arsip_keluar/update/{id}", [
        ArsipKeluarController::class,
        "update_arsipKeluar",
    ])->name("admin.kelola_arsipKeluar.update");
    Route::get("/admin/arsip_keluar/delete/{id}", [
        ArsipKeluarController::class,
        "delete_arsipKeluar",
    ])->name("admin.kelola_arsipKeluar.delete");

    Route::get("/admin/rekap", [
        RekapanArsipController::class,
        "kelola_rekap",
    ])->name("admin.rekap_dokumen");

    Route::get("admin/template_dokumen", [TemplateDokumen::class, 'kelola_template'])->name('admin.template_dokumen');
    Route::get("admin/template_dokumen/add", [TemplateDokumen::class, 'add_template'])->name('admin.template_dokumen.add');
    Route::post("admin/template_dokumen/insert", [TemplateDokumen::class, 'simpan'])->name('admin.template_dokumen.insert');
    Route::get("admin/template_dokumen/lihat/{id}", [TemplateDokumen::class, 'lihat_template'])->name('admin.template_dokumen.lihat');
    Route::get("admin/template_dokumen/edit/{id}", [TemplateDokumen::class, 'edit_template'])->name('admin.template_dokumen.edit');
    Route::get("admin/template_dokumen/update/{id}", [TemplateDokumen::class, 'update_template'])->name('admin.template_dokumen.update');
    Route::get("admin/template_dokumen/delete/{id}", [TemplateDokumen::class, 'delete_template'])->name('admin.template_dokumen.delete');
});

Route::middleware(["auth", "role:pimpinan"])->group(function () {
    Route::get("/pimpinan/dashboard", [
        PimpinanController::class,
        "dashboard",
    ])->name("pimpinan.dashboard");

    // Route::get("pencarian", [Pencarian::class, "pencarian"])->name("pencarian");
    // Route::get("pencarian/detail/{slug}", [
    //     Pencarian::class,
    //     "detail_pencarian",
    // ])->name("pencarian.detail");
});

require __DIR__ . "/auth.php";
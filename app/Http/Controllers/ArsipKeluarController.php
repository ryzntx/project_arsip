<?php

namespace App\Http\Controllers;

use App\Models\DokumenKeluar;

class ArsipKeluarController extends Controller {

    public function kelola_arsip_keluar() {
        $data = DokumenKeluar::with('dokumen_kategori')->with('instansi')->get();
        return view('admin.arsip_keluar.arsip_keluar', compact('data'));
    }
}
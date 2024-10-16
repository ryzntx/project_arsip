<?php

namespace App\Http\Controllers;

use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;

class AdminController extends Controller {

    public function dashboard() {
        $total_dokumen_masuk = DokumenMasuk::count();
        $total_dokumen_keluar = DokumenKeluar::count();
        $total_dokumen = $total_dokumen_keluar + $total_dokumen_masuk;
        return view('dashboard', compact('total_dokumen', 'total_dokumen_keluar', 'total_dokumen_masuk'));
    }

}

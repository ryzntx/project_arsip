<?php

namespace App\Http\Controllers;

use App\Models\DokumenMasuk;
use App\Models\DokumenKeluar;
use Illuminate\Http\Request;


class RekapanArsipController extends Controller
{
    //
    public function kelola_rekap() {

        $arsip_masuk = DokumenMasuk::all();
        $arsip_keluar = DokumenKeluar::all();

        $rekapanDokumen = $arsip_masuk-> concat($arsip_keluar);

        $rekapanDokumen = $rekapanDokumen->sortByDesc('create_at');
        $dokumen_rekapan = $rekapanDokumen;

        // $rekapanDokumee =
        // ->with("dokumen_masuk")
        // ->with("dokumen_keluar")
        // ->with("instansi")
        // ->with("dokumen_kategori")
        // ->first();

        return view('rekapan_dokumen.rekap_dokumen', compact('dokumen_rekapan', 'arsip_masuk', 'arsip_keluar'));
    }


}

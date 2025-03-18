<?php

namespace App\Http\Controllers;

use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;
use Illuminate\Support\Facades\Crypt;

class VerifikasiDokumen extends Controller
{
    public function index(string $nomor_surat)
    {
        $nomor_surat = Crypt::decryptString($nomor_surat);

        $dok_keluar = DokumenKeluar::where('nomor_surat', $nomor_surat)->first();

        dd($dok_keluar);

        return view('verifikasi_dokumen.index');
    }
}

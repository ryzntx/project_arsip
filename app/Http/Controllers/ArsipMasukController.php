<?php

namespace App\Http\Controllers;

use App\Models\DokumenMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipMasukController extends Controller
{
    public function kelola_arsip_masuk()
    {
        $data = DokumenMasuk::with('dokumen_kategori')->with('instansi')->get();
        return view('admin.arsip_masuk.arsip_masuk', compact('data'));
    }

    public function download_arsip_masuk($path_pdf){
        if (!Storage::disk('public')->exists($path_pdf)) {
            abort(404);
        }
        return response()->download(storage_path('app/public/' . $path_pdf));
    }

}
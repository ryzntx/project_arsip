<?php

namespace App\Http\Controllers;

use App\Models\DokumenMasuk;
use Illuminate\Http\Request;

class ArsipMasukController extends Controller
{
    public function index()
    {
        $data = DokumenMasuk::with('dokumen_kategori')->with('instansi')->get();
        return view('admin.arsip_masuk', compact('data'));
    }

}

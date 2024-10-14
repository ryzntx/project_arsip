<?php

namespace App\Http\Controllers;

use App\Models\DokumenKeluar;
use Illuminate\Http\Request;

class ArsipKeluarController extends Controller
{
    public function index()
    {
        $data = DokumenKeluar::with('dokumen_kategori')->with('instansi')->get();
        return view('admin.arsip_keluar.arsip_keluar', compact('data'));
    }
}

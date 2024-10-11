<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DokumenKategori;
use App\Models\Instansi;
use Illuminate\Http\Request;

class TambahDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // TAMBAH DOKUMEN
    public function tambah_dokumen()
    {
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();
        return view('admin.tambah_dokumen.tambah_dokumen', compact('instansi', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jenis_dokumen = $request->jenis_dokumen;
        if($jenis_dokumen == 'dokumen_masuk'){
           $data = [
            'no_dokumen'=>'0',
            'perihal'=>$request->nama_dokumen,
            'penerima'=>$request->nama_penerima,
            'asal_dokumen'=>$request->nama_pengirim,
            'lampiran'=>'0',
            'tanggal_masuk'=>$request->tanggal_dokumen,
            'instansi_id'=>$request->instansi_id,
            'dokumen_kategori_id'=>$request->jenis_dokumen,
            'user_id'=>'0',
           ];
        } elseif ($jenis_dokumen == 'dokumen_keluar'){

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DokumenKategori;
use App\Models\DokumenMasuk;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipMasukController extends Controller
{
    protected $arsip_masuk;
    public function kelola_arsip_masuk()
    {
        $arsip_masuk = DokumenMasuk::with('dokumen_kategori')->with('instansi')->get();
        return view('admin.kelola_arsipMasuk.arsip_masuk', compact('arsip_masuk'));
    }

    public function edit_arsipMasuk($id)
    {
        $arsip_masuk = DokumenMasuk::findOrFail($id);
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();

        return view('admin.kelola_arsipMasuk.edit_arsipMasuk', compact('arsip_masuk', 'instansi', 'kategori'));
    }

    public function update_arsipKeluar(Request $request, $id)
    {
        $arsip_masuk = DokumenMasuk::findOrFail($id);

        $request->validate([
            'nama_dokumen' => $request->nama_dokumen,
            'penerima' => $request->nama_penerima,
            'pengirim' => $request->nama_pengirim,
            'tanggal_masuk' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
            'instansi_id' => $request->dinas_id,
            'dokumen_kategori_id' => $request->kategori_id,
            'user_id' => auth()->user()->id,

        ]);

        $arsip_masuk->update($request->all());

        return redirect()->route('admin.kelola_arsipMasuk')->with('pesan','Data berhasil diubah!');

    // To-Do Fungsi update

}

    // public function download_arsip_masuk($path_pdf){
    //     if (!Storage::disk('public')->exists($path_pdf)) {
    //         abort(404);
    //     }
    //     return response()->download(storage_path('app/public/' . $path_pdf));
    // }

}

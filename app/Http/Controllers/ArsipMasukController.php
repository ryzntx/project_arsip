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
    // FITUR ADMIN
    protected $arsip_masuk;
    public function kelola_arsip_masuk()
    {
        $arsip_masuk = DokumenMasuk::with('dokumen_kategori')->with('instansi')->get();
        return view('admin.arsip_masuk.kelola_arsipMasuk', compact('arsip_masuk'));
    }
    public function print($id)
    {
        $arsip_masuk = DokumenMasuk::with('dokumen_kategori')->with('instansi')->find($id);
        return view('admin.arsip_masuk.print', compact('arsip_masuk'));
    }

    public function edit_arsip_masuk($id)
    {
        $arsip_masuk = DokumenMasuk::findOrFail($id);
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();

        return view('admin.arsip_masuk.edit_arsipMasuk', compact('arsip_masuk', 'instansi', 'kategori'));
    }

    public function update_arsip_masuk(Request $request, $id)
    {
        $arsip_masuk = DokumenMasuk::findOrFail($id);

        $data = [
            'nama_dokumen' => $request->nama_dokumen,
            'penerima' => $request->nama_penerima,
            'pengirim' => $request->nama_pengirim,
            'tanggal_masuk' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
            'instansi_id' => $request->dinas_id,
            'dokumen_kategori_id' => $request->kategori_id,
            'user_id' => auth()->user()->id,

        ];

        $arsip_masuk->update($data);

        return redirect()->route('admin.arsip_masuk')->with('pesan','Data berhasil diubah!');

    // To-Do Fungsi update

}
    public function delete_arsip_masuk($id){
        // To-Do Fungsi Delete
        $arsip_masuk = DokumenMasuk::findOrFail($id);
        $arsip_masuk->delete();

        return redirect()->back()->with('pesan', 'Data berhasil dihapus!');
    }

    // FITUR PIMPINAN
    public function monitoring_arsip_masuk()
    {
        $arsip_masuk = DokumenMasuk::with('dokumen_kategori')->with('instansi')->get();
        return view('pimpinan.Monitor_arsipMasuk.arsipMasuk', compact('arsip_masuk'));

    }

    // public function download_arsip_masuk($path_pdf){
    //     if (!Storage::disk('public')->exists($path_pdf)) {
    //         abort(404);
    //     }
    //     return response()->download(storage_path('app/public/' . $path_pdf));
    // }

}

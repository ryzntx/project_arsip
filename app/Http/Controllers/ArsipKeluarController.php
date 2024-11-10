<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DokumenKategori;
use App\Models\DokumenKeluar;
use App\Models\Instansi;
use Illuminate\Http\Request;

class ArsipKeluarController extends Controller {

    protected $arsip_keluar;

    // FITUR ADMIN
    public function kelola_arsip_keluar() {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->get();
        return view('admin.arsip_keluar.kelola_arsipKeluar', compact('arsip_keluar'));
    }
    public function print($id)
    {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->find($id);
        return view('admin.arsip_keluar.print', compact('arsip_keluar'));
    }

    public function edit_arsip_keluar($id){
        $arsip_keluar = DokumenKeluar::FindOrFail($id);
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();

        return view('admin.arsip_keluar.edit_arsipKeluar', compact('arsip_keluar', 'instansi', 'kategori'));
        // To-do tampilan edit
    }

    public function update_arsip_keluar(Request $request, $id){
        $arsip_keluar = DokumenKeluar::findOrFail($id);

        $data = [
                'nama_dokumen' => $request->nama_dokumen,
                'penerima' => $request->nama_penerima,
                'pengirim' => $request->nama_pengirim,
                'tanggal_keluar' => $request->tanggal_keluar,
                'keterangan' => $request->keterangan,
                'status' => ($request->pengajuan_ke_pimpinan=='ya')?'Menunggu Persetujuan':'Menunggu Dikirim',
                'persetujuan' => $request->pengajuan_ke_pimpinan,
                'instansi_id' => $request->dinas_id,
                'dokumen_kategori_id' => $request->kategori_id,
                'user_id' => auth()->user()->id,

        ];

        $arsip_keluar->update($data);

        return redirect()->route('admin.arsip_keluar')->with('pesan','Data berhasil diubah!');

        // To-Do Fungsi update

    }

    public function delete_arsip_keluar($id){
        // To-Do Fungsi Delete
        $arsip_keluar = DokumenKeluar::findOrFail($id);
        $arsip_keluar->delete();

        return redirect()->back()->with('pesan', 'Data berhasil dihapus!');
    }

    // FITUR PIMPINAN
    public function show()
    {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->get();
        return view('pimpinan.Monitor_arsipKeluar.arsipKeluar', compact('arsip_keluar'));

    }
}

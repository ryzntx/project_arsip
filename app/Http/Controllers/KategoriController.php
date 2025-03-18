<?php

namespace App\Http\Controllers;

use App\Models\DokumenKategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    protected $kategori;

    public function kelola_kategori()
    {
        $kategori = DokumenKategori::all();

        return view('admin.kategori.kelola_kategori', compact('kategori'));
    }

    public function kelolaSampahKategori()
    {
        $kategori = DokumenKategori::onlyTrashed()->get();

        return view('admin.kategori.sampah', compact('kategori'));
    }

    public function add_kategori()
    {
        return view('admin.kategori.add_kategori');
    }

    public function insert_kategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'nomor_surat' => 'required',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nomor_surat.required' => 'Nomor surat wajib diisi!',
        ]);

        DokumenKategori::create($request->all());

        return redirect()->route('admin.kelola_kategori')->with('pesan', 'Data kategori berhasil ditambahkan!');
    }

    public function edit_kategori($id)
    {
        $kategori = DokumenKategori::findOrFail($id);

        return view('admin.kategori.edit_kategori', compact('kategori'));
        // To-do tampilan edit
    }

    public function update_kategori(Request $request, $id)
    {
        $kategori = DokumenKategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required',
            'nomor_surat' => 'required',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nomor_surat.required' => 'Nomor surat wajib diisi!',
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.kelola_kategori')->with('pesan', 'Data kategori berhasil di ubah!');

        // To-Do Fungsi update

    }

    public function delete_kategori($id)
    {
        // To-Do Fungsi Delete
        $kategori = DokumenKategori::findOrFail($id);
        $kategori->delete();

        return redirect()->back()->with('pesan', 'Data kategori berhasil dihapus!');
    }

    public function restore_kategori($id)
    {
        // To-Do Fungsi Restore
        $kategori = DokumenKategori::onlyTrashed()->findOrFail($id);
        $kategori->restore();

        return redirect()->back()->with('pesan', 'Data kategori berhasil direstore!');
    }

    public function delete_permanen_kategori($id)
    {
        // To-Do Fungsi Delete Permanen
        $kategori = DokumenKategori::onlyTrashed()->findOrFail($id);
        $kategori->forceDelete();

        return redirect()->back()->with('pesan', 'Data kategori berhasil dihapus permanen!');
    }
}

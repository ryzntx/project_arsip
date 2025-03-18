<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function kelola_instansi()
    {
        $instansi = Instansi::all();

        return view('admin.instansi.kelola_instansi', compact('instansi'));
    }

    public function kelola_sampah_instansi()
    {
        $instansi = Instansi::onlyTrashed()->get();

        return view('admin.instansi.sampah', compact('instansi'));
    }

    public function add_instansi()
    {
        return view('admin.instansi.add_instansi');
    }

    public function insert_instansi(Request $request)
    {
        // Validasi data terlebih dahulu
        $request->validate([
            'nama_instansi' => 'required',
            'singkatan_instansi' => 'required',
            'alamat' => 'required',
        ], [
            'nama_instansi.required' => 'Nama instansi wajib diisi!',
            'singkatan_instansi.required' => 'Inisial instansi wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
        ]);

        Instansi::create($request->all());

        return redirect()->route('admin.kelola_instansi')->with('pesan', 'Data instansi berhasil di tambahkan!');
    }

    public function edit_instansi($id)
    {
        $instansi = Instansi::findOrFail($id);

        return view('admin.instansi.edit_instansi', compact('instansi'));
        // To-do tampilan edit
    }

    public function update_instansi(Request $request, $id)
    {
        $instansi = Instansi::findOrFail($id);

        $request->validate([
            'nama_instansi' => 'required',
            'singkatan_instansi' => 'required',
            'alamat' => 'required',
        ], [
            'nama_instansi.required' => 'Nama instansi wajib diisi!',
            'singkatan_instansi.required' => 'Inisial instansi wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
        ]);

        $instansi->update($request->all());

        return redirect()->route('admin.kelola_instansi')->with('pesan', 'Data instansi berhasil di ubah!');

        // To-Do Fungsi update

    }

    public function delete_instansi($id)
    {
        // To-Do Fungsi Delete
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->back()->with('pesan', 'Data instansi berhasil dihapus!');
    }

    public function restore_instansi($id)
    {
        // To-Do Fungsi Restore
        $instansi = Instansi::withTrashed()->findOrFail($id);
        $instansi->restore();

        return redirect()->back()->with('pesan', 'Data instansi berhasil di restore!');
    }

    public function delete_permanen_instansi($id)
    {
        // To-Do Fungsi Delete Permanen
        $instansi = Instansi::withTrashed()->findOrFail($id);
        $instansi->forceDelete();

        return redirect()->back()->with('pesan', 'Data instansi berhasil dihapus permanen!');
    }
}

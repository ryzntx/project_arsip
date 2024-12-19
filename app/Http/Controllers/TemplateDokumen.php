<?php

namespace App\Http\Controllers;

use App\OfficeProcessor;
use Illuminate\Http\Request;
use App\Models\DokumenKategori;
use App\Models\DokumenTemplate;
use Illuminate\Support\Facades\Storage;

class TemplateDokumen extends Controller {
    use OfficeProcessor;
    /**
     * Display a listing of the resource.
     */
    public function kelola_template() {
        $data = DokumenTemplate::with('kategori')->get();
        return view('admin.kelola_template.template_dokumen', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_template() {
        $kategori = DokumenKategori::all();
        return view('admin.kelola_template.add_template', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function simpan(Request $request) {
        $data = [
            'nama' => $request->nama_dokumen,
            'dokumen_kategori_id' => $request->kategori_dokumen,
            'user_id' => auth()->user()->id,
        ];
        $request->validate([
            'nama_dokumen' => 'required',
            'kategori_dokumen' => 'required',
            'file_template' => 'required|mimes:doc,docx',
        ]);

        if ($request->hasFile('file_template')) {
            $file = $request->file('file_template');
            $namaFile = preg_replace(
                '/[^A-Za-z0-9\-]/',
                '_',
                $request->nama_dokumen
            ) . '-' . time();
            // $filename = $file->has
            $path = $file->storeAs('dokumen/template', $namaFile . '.' . $file->getClientOriginalExtension(), 'public');
            $data['file'] = $path;

            // get variabel from template
            $var = $this->ambilVariabelTemplate($path);

            // convert to json for save to database
            $data['data'] = json_encode($var);
        }

        DokumenTemplate::create($data);

        return redirect()->route('admin.template_dokumen')->with('pesan', 'Template berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function lihat_template(string $id) {
        $data = DokumenTemplate::with('kategori')->findOrFail($id);
        $kategori = DokumenKategori::all();
        // dd($data);
        return view('admin.kelola_template.lihat_template', compact('data', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_template(string $id) {
        $data = DokumenTemplate::findOrFail($id);
        $kategori = DokumenKategori::all();
        return view('admin.kelola_template.edit_template', compact('data', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_template(Request $request, string $id) {
        //
        $dokumen = DokumenTemplate::findOrFail($id);

        $data = [
            'nama' => $request->nama_dokumen,
            'dokumen_kategori_id' => $request->kategori_dokumen,
            'user_id' => auth()->user()->id,
        ];
        $request->validate([
            'nama_dokumen' => 'required',
            'kategori_dokumen' => 'required',
        ]);

        if ($request->hasFile('file_template')) {
            // validasi file
            $request->validate([
                'file_template' => 'required|mimes:doc,docx',
            ]);

            // hapus file lama
            $path = storage_path('app/public/' . $dokumen->file);

            if (file_exists($path)) {
                unlink($path);
            }

            // simpan file baru
            $file = $request->file('file_template');
            $namaFile = preg_replace(
                '/[^A-Za-z0-9\-]/',
                '_',
                $request->nama_dokumen
            ) . '-' . time();
            $path = $file->storeAs('dokumen/template', $namaFile . '.' . $file->getClientOriginalExtension(), 'public');
            $data['file'] = $path;

            // get variabel from template
            $var = $this->ambilVariabelTemplate($path);

            // convert to json for save to database
            $data['data'] = json_encode($var);
        }

        $dokumen->update($data);

        return redirect()->route('admin.template_dokumen')->with('pesan', 'Template berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_template(string $id) {
        //
        $data = DokumenTemplate::findOrFail($id);
        // delete file
        $path = storage_path('app/public/' . $data->file);
        if (file_exists($path)) {
            unlink($path);
        }
        // delete data
        $data->delete();

        return redirect()->route('admin.template_dokumen')->with('pesan', 'Template berhasil dihapus');
    }


}
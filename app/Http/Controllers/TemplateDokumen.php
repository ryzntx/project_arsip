<?php

namespace App\Http\Controllers;

use App\Models\DokumenKategori;
use App\Models\DokumenTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateDokumen extends Controller {
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

        return redirect()->route('admin.template_dokumen')->with('success', 'Template berhasil ditambahkan');

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

        return redirect()->route('admin.template_dokumen')->with('success', 'Template berhasil diubah');
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

        return redirect()->route('admin.template_dokumen')->with('success', 'Template berhasil dihapus');
    }

    /**
     * Mengambil variabel template dari file Word.
     *
     * Fungsi ini membaca file template Word yang diberikan dan mengekstrak semua variabel
     * yang ada di dalamnya. Variabel diidentifikasi dengan pola '${...}' dan disimpan dalam
     * array yang dikembalikan oleh fungsi ini.
     *
     * @param string $lokasiTemplate Lokasi file template Word yang akan dibaca.
     * @return array Daftar variabel yang ditemukan dalam template.
     */
    public function ambilVariabelTemplate($lokasiTemplate): array {
        $dataVar = [];
        // read template file
        $reader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        $phpWord = $reader->load(storage_path('app/public/' . $lokasiTemplate));
        $section = $phpWord->getSections();
        foreach ($section as $s) {
            $elements = $s->getElements();
            // dd($elements);
            foreach ($elements as $element) {
                // echo "TextRun: " . (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun' ? 'true' : 'false') . "<br>";
                if (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun') {
                    $textRun = $element->getElements();
                    foreach ($textRun as $text) {
                        // echo "Text :" . $text->getText() . "<br>";
                        if (strpos($text->getText(), '${') !== false) {
                            // echo "Text: " . ($text->getText()) . "<br>";
                            $dataVar[] = preg_replace('/[^A-Za-z0-9\-]/', '', $text->getText());
                        }
                    }
                }
                if (get_class($element) == 'PhpOffice\PhpWord\Element\ListItemRun') {
                    $listItemRun = $element->getElements();
                    foreach ($listItemRun as $text) {
                        // echo "Text :" . $text->getText() . "<br>";
                        if (strpos($text->getText(), '${') !== false) {
                            // echo "Text: " . ($text->getText()) . "<br>";
                            $dataVar[] = preg_replace('/[^A-Za-z0-9\-]/', '', $text->getText());
                        }
                    }
                }
            }
        }

        return $dataVar;

    }
}
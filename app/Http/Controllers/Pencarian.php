<?php

namespace App\Http\Controllers;

use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;
use App\Models\PdfDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Pencarian extends Controller {

    /**
     * Melakukan pencarian dokumen PDF berdasarkan query yang diberikan.
     *
     * @param \Illuminate\Http\Request $request Objek request yang berisi query pencarian.
     * @return \Illuminate\View\View Mengembalikan view hasil pencarian dengan data pencarian.
     */
    public function pencarian(Request $request) {
        // Jika query pencarian tidak diberikan, maka tampilkan semua dokumen PDF
        if ($request->query('kata_kunci') !== null) {
            // Melakukan pencarian dokumen PDF berdasarkan query yang diberikan
            $pencarian = PdfDocument::search($request->query("kata_kunci"))->paginate(
                5);
        } else {
            // Menampilkan semua dokumen PDF
            $pencarian = PdfDocument::paginate(5);
        }

        // Mengembalikan view hasil pencarian dengan data pencarian
        return view("pencarian/pencarian_dokumen", compact("pencarian"));
    }

    /**
     * Menampilkan detail pencarian berdasarkan slug.
     *
     * @param string $slug Slug yang akan dikonversi menjadi teks normal untuk mencari data.
     * @return \Illuminate\View\View Tampilan detail pencarian dengan data dokumen yang ditemukan.
     */
    public function detail_pencarian($slug) {
        // Mengubah slug menjadi teks normal
        $title = Str::title(str_replace("-", " ", $slug));
        // Mencari dokumen masuk berdasarkan nama dokumen
        $jenis_dokumen = "Dokumen Masuk";
        $dokumen = DokumenMasuk::where("nama_dokumen", $title)
            ->with("instansi")
            ->with("dokumen_kategori")
            ->join('pdf_documents', 'dokumen_masuks.nama_dokumen', '=', 'pdf_documents.title')
            ->first();
        // Jika dokumen masuk tidak ditemukan, maka cari dokumen keluar
        if ($dokumen == null) {
            $jenis_dokumen = "Dokumen Keluar";
            $dokumen = DokumenKeluar::where("nama_dokumen", $title)
                ->with("instansi")
                ->with("dokumen_kategori")
                ->join('pdf_documents', 'dokumen_keluars.nama_dokumen', '=', 'pdf_documents.title')
                ->first();
        }
        // Mengembalikan tampilan detail pencarian
        return view("pencarian/detail_pencarian", compact("dokumen", "jenis_dokumen"));
    }
}

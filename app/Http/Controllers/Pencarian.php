<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Support\Str;
use App\Models\DokumenMasuk;
use Illuminate\Http\Request;
use App\Models\DokumenKeluar;
use App\Models\DokumenKategori;

class Pencarian extends Controller {

    /**
     * Melakukan pencarian dokumen PDF berdasarkan query yang diberikan.
     *
     * @param \Illuminate\Http\Request $request Objek request yang berisi query pencarian.
     * @return \Illuminate\View\View Mengembalikan view hasil pencarian dengan data pencarian.
     */
    public function pencarian(Request $request) {

        $rquery = $request->query() ?? [];
        // Mengambil semua kategori dokumen dari database
        $kategori = DokumenKategori::all();
        // Mengambil semua instansi dari database
        $instansi = Instansi::all();

        // Membuat query builder untuk dokumen masuk
        $arsip_masuk = DokumenMasuk::query();
        // Membuat query builder untuk dokumen keluar
        $arsip_keluar = DokumenKeluar::query();

        // Filter berdasarkan kategori dokumen jika ada dalam query string
        if (isset($rquery['kategori_dokumen'])) {
            $arsip_masuk = $arsip_masuk->where('dokumen_kategori_id', $rquery['kategori_dokumen']);
            $arsip_keluar = $arsip_keluar->where('dokumen_kategori_id', $rquery['kategori_dokumen']);
        }
        // Filter berdasarkan instansi jika ada dalam query string
        if (isset($rquery['instansi'])) {
            $arsip_masuk = $arsip_masuk->where('instansi_id', $rquery['instansi']);
            $arsip_keluar = $arsip_keluar->where('instansi_id', $rquery['instansi']);
        }
        // Filter berdasarkan bulan jika ada dalam query string
        if (isset($rquery['bulan'])) {
            $bulan = $rquery['bulan'];
            $arsip_masuk = $arsip_masuk->whereMonth('tanggal_masuk', $bulan);
            $arsip_keluar = $arsip_keluar->whereMonth('tanggal_keluar', $bulan);
        }
        // Filter berdasarkan tahun jika ada dalam query string
        if (isset($rquery['tahun'])) {
            $tahun = $rquery['tahun'];
            $arsip_masuk = $arsip_masuk->whereYear('tanggal_masuk', $tahun);
            $arsip_keluar = $arsip_keluar->whereYear('tanggal_keluar', $tahun);
        }
        // Filter berdasarkan rentang tanggal jika ada dalam query string
        if (isset($rquery['tanggal'])) {
            // Memisahkan rentang tanggal dengan delimiter ' - '
            $date = explode(' - ', $rquery['tanggal']);

            $arsip_masuk = $arsip_masuk->whereBetween('tanggal_masuk', $date);
            $arsip_keluar = $arsip_keluar->whereBetween('tanggal_keluar', $date);
        }

        // Jika query pencarian tidak diberikan, maka tampilkan semua dokumen PDF
        if (isset($rquery['kata_kunci'])) {
            // Melakukan pencarian dokumen PDF berdasarkan query yang diberikan
            $arsip_masuk = $arsip_masuk->when($request->query('kata_kunci'), function ($query, $kata_kunci) {
                    $query->whereFullText(['nama_dokumen', 'pdf_content'], $kata_kunci);
                }, function ($query) {
                    return $query->latest();
                });

            $arsip_keluar = $arsip_keluar->when($request->query('kata_kunci'), function ($query, $kata_kunci) {
                    $query->whereFullText(['nama_dokumen', 'pdf_content'], $kata_kunci);
                }, function ($query) {
                    return $query->latest();
                });
        }

        // Mengambil semua dokumen masuk yang telah difilter
        $arsip_masuk = $arsip_masuk->get();
        // Mengambil semua dokumen keluar yang telah difilter
        $arsip_keluar = $arsip_keluar->get();

        // Menggabungkan hasil pencarian dokumen masuk dan keluar
        $pencarian = $arsip_masuk->concat($arsip_keluar)->sortByDesc('created_at')->paginate(5);

        if (isset($rquery['jenis_dokumen'])) {
            if ($rquery['jenis_dokumen'] == 'dokumen_masuk') {
                // Jika jenis dokumen adalah dokumen masuk, urutkan dokumen masuk saja
                $pencarian = $arsip_masuk->sortByDesc('created_at')->paginate(5);
            } else if ($rquery['jenis_dokumen'] == 'dokumen_keluar') {
                // Jika jenis dokumen adalah dokumen keluar, urutkan dokumen keluar saja
                $pencarian = $arsip_keluar->sortByDesc('created_at')->paginate(5);
            }
        }

        // Mengembalikan view hasil pencarian dengan data pencarian
        return view("pencarian/pencarian_dokumen", compact("pencarian", "kategori", "instansi"));
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
            ->first();
        // Jika dokumen masuk tidak ditemukan, maka cari dokumen keluar
        if ($dokumen == null) {
            $jenis_dokumen = "Dokumen Keluar";
            $dokumen = DokumenKeluar::where("nama_dokumen", $title)
                ->with("instansi")
                ->with("dokumen_kategori")
                ->first();
        }
        // Mengembalikan tampilan detail pencarian
        return view("pencarian/detail_pencarian", compact("dokumen", "jenis_dokumen"));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\DokumenKategori;
use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;
use App\Models\Instansi;
use Illuminate\Http\Request;

class RekapanArsipController extends Controller {
    //
    /**
     * Mengelola rekap dokumen berdasarkan filter yang diberikan melalui query string.
     *
     * @param \Illuminate\Http\Request $request Objek request yang berisi query string untuk filter.
     * @return \Illuminate\View\View Mengembalikan view 'rekapan_dokumen.rekap_dokumen' dengan data rekapan dokumen.
     *
     * Query string yang didukung:
     * - kategori_dokumen: Filter berdasarkan kategori dokumen.
     * - instansi: Filter berdasarkan instansi.
     * - bulan: Filter berdasarkan bulan (format angka, 1-12).
     * - tahun: Filter berdasarkan tahun (format angka, 4 digit).
     * - tanggal: Filter berdasarkan rentang tanggal (format 'YYYY-MM-DD - YYYY-MM-DD').
     * - jenis_dokumen: Filter berdasarkan jenis dokumen ('dokumen_masuk' atau 'dokumen_keluar').
     *
     * Variabel yang dikirim ke view:
     * - dokumen_rekapan: Koleksi dokumen yang telah difilter dan diurutkan.
     * - kategori: Semua kategori dokumen.
     * - instansi: Semua instansi.
     */
    public function kelola_rekap(Request $request) {

        // Mengambil query string dari request atau menginisialisasi array kosong jika tidak ada
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

        // Mengambil semua dokumen masuk yang telah difilter
        $arsip_masuk = $arsip_masuk->get();
        // Mengambil semua dokumen keluar yang telah difilter
        $arsip_keluar = $arsip_keluar->get();

        // Menggabungkan dokumen masuk dan keluar
        $rekapanDokumen = $arsip_masuk->concat($arsip_keluar);

        // Mengurutkan dokumen berdasarkan tanggal pembuatan secara descending
        $rekapanDokumen = $rekapanDokumen->sortByDesc('created_at');
        // Menyimpan hasil pengurutan ke variabel dokumen_rekapan
        $dokumen_rekapan = $rekapanDokumen;

        // Filter berdasarkan jenis dokumen jika ada dalam query string
        if (isset($rquery['jenis_dokumen'])) {
            if ($rquery['jenis_dokumen'] == 'dokumen_masuk') {
                // Jika jenis dokumen adalah dokumen masuk, urutkan dokumen masuk saja
                $rekapanDokumen = $arsip_masuk->sortByDesc('created_at');
                $dokumen_rekapan = $rekapanDokumen;
            } else if ($rquery['jenis_dokumen'] == 'dokumen_keluar') {
                // Jika jenis dokumen adalah dokumen keluar, urutkan dokumen keluar saja
                $rekapanDokumen = $arsip_keluar->sortByDesc('created_at');
                $dokumen_rekapan = $rekapanDokumen;
            }
        }

        // Mengembalikan view 'rekapan_dokumen.rekap_dokumen' dengan data yang telah difilter dan diurutkan
        return view('rekapan_dokumen.rekap_dokumen', compact('dokumen_rekapan', 'kategori', 'instansi'));
    }

}
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

        $rquery = $request->query() ?? [];
        $kategori = DokumenKategori::all();
        $instansi = Instansi::all();

        $arsip_masuk = DokumenMasuk::query();
        $arsip_keluar = DokumenKeluar::query();

        if (isset($rquery['kategori_dokumen'])) {
            $arsip_masuk = $arsip_masuk->where('dokumen_kategori_id', $rquery['kategori_dokumen']);
            $arsip_keluar = $arsip_keluar->where('dokumen_kategori_id', $rquery['kategori_dokumen']);
        }
        if (isset($rquery['instansi'])) {
            $arsip_masuk = $arsip_masuk->where('instansi_id', $rquery['instansi']);
            $arsip_keluar = $arsip_keluar->where('instansi_id', $rquery['instansi']);
        }
        if (isset($rquery['bulan'])) {
            $bulan = $rquery['bulan'];
            $arsip_masuk = $arsip_masuk->whereMonth('tanggal_masuk', $bulan);
            $arsip_keluar = $arsip_keluar->whereMonth('tanggal_keluar', $bulan);
        }
        if (isset($rquery['tahun'])) {
            $tahun = $rquery['tahun'];
            $arsip_masuk = $arsip_masuk->whereYear('tanggal_masuk', $tahun);
            $arsip_keluar = $arsip_keluar->whereYear('tanggal_keluar', $tahun);
        }
        if (isset($rquery['tanggal'])) {
            // pisahkan tanggal dengan -
            $date = explode(' - ', $rquery['tanggal']);

            $arsip_masuk = $arsip_masuk->whereBetween('tanggal_masuk', $date);
            $arsip_keluar = $arsip_keluar->whereBetween('tanggal_keluar', $date);
        }

        $arsip_masuk = $arsip_masuk->get();
        $arsip_keluar = $arsip_keluar->get();

        $rekapanDokumen = $arsip_masuk->concat($arsip_keluar);

        $rekapanDokumen = $rekapanDokumen->sortByDesc('created_at');
        $dokumen_rekapan = $rekapanDokumen;

        if (isset($rquery['jenis_dokumen'])) {
            if ($rquery['jenis_dokumen'] == 'dokumen_masuk') {
                $rekapanDokumen = $arsip_masuk->sortByDesc('created_at');
                $dokumen_rekapan = $rekapanDokumen;
            } else if ($rquery['jenis_dokumen'] == 'dokumen_keluar') {
                $rekapanDokumen = $arsip_keluar->sortByDesc('created_at');
                $dokumen_rekapan = $rekapanDokumen;
            }
        }

        return view('rekapan_dokumen.rekap_dokumen', compact('dokumen_rekapan', 'kategori', 'instansi', ));
    }

}

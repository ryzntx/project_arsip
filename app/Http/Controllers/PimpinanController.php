<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DokumenKategori;
use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;
use App\Models\Instansi;

class PimpinanController extends Controller {
    public function dashboard() {
        // init data
        $instansi = Instansi::all();
        $kategori_dokumen = DokumenKategori::all();
        $dokumen_masuk = DokumenMasuk::all();
        $dokumen_keluar = DokumenKeluar::all();

        $tahun = [];
        for ($i = 2020; $i <= date('Y'); $i++) {
            $tahun[$i] = $i;
        }

        // total dokumen
        $total_dokumen_masuk = DokumenMasuk::count();
        $total_dokumen_keluar = DokumenKeluar::count();
        $total_dokumen = $total_dokumen_keluar + $total_dokumen_masuk;

        // data per month
        $dokumen_masuk_month = DokumenMasuk::selectRaw('MONTH(created_at) as month, MONTHNAME(created_at) as month_name, COUNT(*) as total')
            ->groupBy('month', 'month_name')
            ->get();

        $dokumen_keluar_month = DokumenKeluar::selectRaw('MONTH(created_at) as month, MONTHNAME(created_at) as month_name, COUNT(*) as total')
            ->groupBy('month', 'month_name')
            ->get();

        // data per year
        $dokumen_masuk_year = DokumenMasuk::selectRaw('YEAR(created_at) AS year, COUNT(*) as total')
            ->groupBy('year')
            ->get();
        $dokumen_keluar_year = DokumenKeluar::selectRaw('YEAR(created_at) AS year, COUNT(*) as total')
            ->groupBy('year')
            ->get();

        // group by kategori dokumen
        $dokumen_masuk_kategori = DokumenMasuk::selectRaw('dokumen_kategori_id, COUNT(*) as total')
            ->with('dokumen_kategori')
            ->groupBy('dokumen_kategori_id')
            ->get();

        $dokumen_keluar_kategori = DokumenKeluar::selectRaw('dokumen_kategori_id, COUNT(*) as total')
            ->with('dokumen_kategori')
            ->groupBy('dokumen_kategori_id')
            ->get();

        // group by instansi
        $dokumen_masuk_instansi = DokumenMasuk::selectRaw('instansi_id, COUNT(*) as total')
            ->with('instansi')
            ->groupBy('instansi_id')
            ->get();
        $dokumen_keluar_instansi = DokumenKeluar::selectRaw('instansi_id, COUNT(*) as total')
            ->with('instansi')
            ->groupBy('instansi_id')
            ->get();

        // filter data
        if (request()->query('tahun')) {
            $dokumen_masuk_month = DokumenMasuk::selectRaw('MONTH(created_at) as month, MONTHNAME(created_at) as month_name, COUNT(*) as total')
                ->whereYear('created_at', request()->query('tahun'))
                ->groupBy('month', 'month_name')
                ->get();

            $dokumen_keluar_month = DokumenKeluar::selectRaw('MONTH(created_at) as month, MONTHNAME(created_at) as month_name, COUNT(*) as total')
                ->whereYear('created_at', request()->query('tahun'))
                ->groupBy('month', 'month_name')
                ->get();
        }

        return view('dashboard', compact('total_dokumen', 'total_dokumen_keluar', 'total_dokumen_masuk', 'dokumen_masuk_month', 'dokumen_keluar_month', 'dokumen_masuk_kategori', 'dokumen_keluar_kategori', 'kategori_dokumen', 'instansi', 'dokumen_masuk_year', 'dokumen_keluar_year', 'dokumen_masuk_instansi', 'dokumen_keluar_instansi', 'tahun'));
    }
}

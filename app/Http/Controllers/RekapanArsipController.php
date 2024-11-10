<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapanArsipController extends Controller
{
    //
    public function kelola_rekap() {
        return view('rekap_dokumen');
    }
}

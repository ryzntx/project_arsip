<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function pencarian() {
        return view('Pencarian.pencarian_dokumen');
    }

    public function search() {
        return view('Pencarian.layout_pencarian');
    }

}

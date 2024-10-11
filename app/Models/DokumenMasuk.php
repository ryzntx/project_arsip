<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenMasuk extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_dokumen',
        'perihal',
        'penerima',
        'asal_dokumen',
        'lampiran',
        'tanggal_masuk',
        'instansi_id',
        'dokumen_kategori_id',
        'user_id',
    ];
}

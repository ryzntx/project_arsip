<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DokumenKategori extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_kategori',
        'nomor_surat',
    ];
}

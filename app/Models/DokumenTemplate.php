<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DokumenTemplate extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'file',
        'data',
        'dokumen_kategori_id',
        'user_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(DokumenKategori::class, 'dokumen_kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

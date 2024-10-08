<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenKeluar extends Model {
    use HasFactory;

    protected $fillable = [
        'no_dokumen',
        'nama_dokumen',
        'penerima',
        'pengirim',
        'lampiran',
        'tanggal_keluar',
        'status',
        'persetujuan',
        'keterangan',
        'instansi_id',
        'dokumen_kategori_id',
        'user_id',
    ];

    public function instansi(): BelongsTo {
        return $this->belongsTo(Instansi::class);
    }

    public function dokumen_kategori(): BelongsTo {
        return $this->belongsTo(DokumenKategori::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
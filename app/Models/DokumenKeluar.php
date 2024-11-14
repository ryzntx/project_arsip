<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenKeluar extends Model {
    use HasFactory;

    protected $fillable = [
        'nama_dokumen',
        'penerima',
        'pengirim',
        'lampiran',
        'status',
        'persetujuan',
        'keterangan',
        'tanggal_keluar',
        'bukti_dikirimkan',
        'instansi_id',
        'dokumen_kategori_id',
        'user_id',
    ];

    // Relasi ke model Instansi
    public function instansi(): BelongsTo {
        return $this->belongsTo(Instansi::class);
    }

    // Relasi ke model DokumenKategori
    public function dokumen_kategori(): BelongsTo {
        return $this->belongsTo(DokumenKategori::class);
    }

    // Relasi ke model User
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
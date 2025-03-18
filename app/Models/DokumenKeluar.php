<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class DokumenKeluar extends BaseModel
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'nama_dokumen',
        // 'pengirim',
        'penerima',
        'lampiran',
        'status',
        'sifat_dokumen',
        'nomor_surat',
        'nomor_urut',
        'keterangan',
        'tanggal_keluar',
        'bukti_dikirimkan',
        'instansi_id',
        'dokumen_kategori_id',
        'user_id',
        'pdf_content',
        'alasan',
        'disetujui',
    ];

    #[SearchUsingFullText(['nama_dokumen', 'pdf_content'])]
    public function toSearchableArray()
    {
        return [
            'nama_dokumen' => $this->nama_dokumen,
            'pdf_content' => $this->pdf_content,
            'penerima' => $this->penerima,
            'tanggal_keluar' => $this->tanggal_keluar,
        ];
    }

    // Relasi ke model Instansi
    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class);
    }

    // Relasi ke model DokumenKategori
    public function dokumen_kategori(): BelongsTo
    {
        return $this->belongsTo(DokumenKategori::class);
    }

    // Relasi ke model User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

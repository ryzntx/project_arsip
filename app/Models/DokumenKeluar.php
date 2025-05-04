<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'data_surat',
        'dok_template_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'data_surat' => 'array',
            'tanggal_keluar' => 'datetime',
        ];
    }

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

    // relasi ke model dok template
    public function dok_template(): BelongsTo
    {
        return $this->belongsTo(DokumenTemplate::class, 'dok_template_id');
    }

    protected function dataSurat(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (empty($value)) return [];

                $firstDecode = json_decode($value, true);

                if (is_string($firstDecode)) {
                    // Kalau decode pertama hasilnya string, berarti perlu decode lagi
                    $firstDecode = json_decode($firstDecode, true);
                }

                if (json_last_error() !== JSON_ERROR_NONE) {
                    return [];
                }

                // Bersihkan prefix 'var_'
                $mapped = [];
                foreach ($firstDecode as $key => $val) {
                    $newKey = str_replace('var_', '', $key);
                    $mapped[$newKey] = $val;
                }

                return $mapped;
            },
            set: function ($value) {
                if (is_string($value)) {
                    return $value;
                }

                return json_encode($value);
            }
        );
    }
}

<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PdfDocument extends Model
{
    use Searchable;

    protected $fillable = [
        "title",
        "content",
        "file_name",
    ];

    #[SearchUsingFullText(["title", "content"])]
    public function toSearchableArray()
    {
        return [
            "title" => $this->title,
            "content" => $this->content,
        ];
    }

    public function getAll(){
        return DB::table('pdf_documents')
            ->selectRaw('dokumen_masuks.id AS dokumenMasuk_id, dokumen_keluars.id AS dokumenKeluar_id, pdf_documents.title, pdf_documents.content, pdf_documents.file_name')
            ->leftJoin('dokumen_masuks', 'pdf_documents.title', '=', 'dokumen_masuks.nama_dokumen')
            ->leftJoin('dokumen_keluars', 'pdf_documents.title', '=', 'dokumen_keluars.nama_dokumen')
            ->get();
    }
}

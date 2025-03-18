<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instansi extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_instansi',
        'singkatan_instansi',
        'alamat',
    ];
}

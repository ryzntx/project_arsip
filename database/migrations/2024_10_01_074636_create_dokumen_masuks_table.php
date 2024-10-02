<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumen_masuks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('dinas_id');
            $table->string('pengirim');
            $table->string('penerima');
            $table->string('nama_dokumen');
            $table->string('kategori');
            $table->string('lampiran_dokumen');
            $table->string('keterangan');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumenmasuks');
    }
};

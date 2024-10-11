<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('dokumen_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->string('pengirim');
            $table->string('penerima');
            $table->string('lampiran');
            $table->enum('status', ['Menunggu Persetujuan', 'Disetujui', 'Ditolak', 'Menunggu Dikirim', 'Dikirimkan'])->default('Menunggu Persetujuan');
            $table->string('keterangan')->nullable();
            $table->boolean('persetujuan')->default(false);
            $table->date('tanggal_dikirim');
            $table->string('bukti_dikirimkan')->nullable();
            $table->foreignId('instansi_id')->constrained();
            $table->foreignId('dokumen_kategori_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('dokumen_keluars');
    }
};

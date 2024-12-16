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
            // $table->string('pengirim');
            $table->string('penerima');
            $table->string('lampiran');
            $table->enum('status', ['Menunggu Persetujuan', 'Disetujui', 'Ditolak', 'Menunggu Dikirim', 'Dikirimkan', 'Selesai'])->default('Menunggu Persetujuan');
            $table->string('keterangan')->nullable();
            $table->enum('persetujuan', ['ya', 'tidak'])->default('tidak');
            $table->date('tanggal_keluar');
            $table->string('bukti_dikirimkan')->nullable();
            $table->foreignId('instansi_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('dokumen_kategori_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->text('pdf_content')->nullable();
            $table->timestamps();

            $table->fullText('nama_dokumen');
            $table->fullText('pdf_content');
            $table->fullText(['nama_dokumen', 'pdf_content']);

            // set charset and collation to utf8mb4
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('dokumen_keluars');
    }
};
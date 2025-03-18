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
        Schema::table('dokumen_keluars', function (Blueprint $table) {
            //
            $table->string('nomor_surat')->nullable();
            $table->string('nomor_urut')->nullable();
            $table->boolean('sifat_dokumen')->default(0);
            $table->tinyInteger('disetujui')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen_keluars', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::create('dokumen_templates', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('file');
            $table->json('data');
            $table->foreignId('dokumen_kategori_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.di
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_template');
    }
};
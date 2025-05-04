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
            $table->foreignId('dok_template_id')->nullable()->constrained('dokumen_templates')->after('data_surat');
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

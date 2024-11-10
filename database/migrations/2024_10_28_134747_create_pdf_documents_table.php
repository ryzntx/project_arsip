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
        Schema::create('pdf_documents', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            $table->text('file_name')->nullable();
            $table->timestamps();

            $table->fullText('title');
            $table->fullText('content');

            $table->fullText(['title', 'content']);

            // set charset and collation to utf8mb4
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_documents');
    }
};

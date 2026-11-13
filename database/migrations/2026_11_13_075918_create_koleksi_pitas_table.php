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
        Schema::create('koleksi_pitas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_koleksi', 50)->unique();
            $table->string('nama_koleksi', 255);
            $table->foreignId('kategori_format_id')->constrained('kategori_formats')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koleksi_pitas');
    }
};

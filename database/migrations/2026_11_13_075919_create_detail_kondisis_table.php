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
        Schema::create('detail_kondisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('koleksi_pita_id')->unique()->constrained('koleksi_pitas')->cascadeOnDelete();
            $table->text('kondisi_awal');
            $table->enum('tingkat_kerusakan', ['ringan', 'sedang', 'berat'])->default('sedang');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kondisis');
    }
};

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
        Schema::create('koleksi_tindakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('koleksi_pita_id')->constrained('koleksi_pitas')->cascadeOnDelete();
            $table->foreignId('tindakan_restorasi_id')->constrained('tindakan_restorasis')->cascadeOnDelete();
            $table->enum('status', ['rencana', 'proses', 'selesai'])->default('rencana');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Index for faster queries
            $table->index(['koleksi_pita_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koleksi_tindakan');
    }
};

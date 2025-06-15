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
        Schema::create('penyalurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerima_id')
              ->constrained('penerimas')
              ->onDelete('restrict'); // Mencegah penerima dihapus jika masih punya riwayat penyaluran

            // Foreign Key ke tabel amils
            $table->foreignId('amil_id')
                ->constrained('amils')
                ->onDelete('restrict'); // Mencegah amil dihapus jika masih punya riwayat penyaluran

            // Kolom untuk jumlah
            $table->decimal('uang', 15, 2)->nullable(); // Menggunakan decimal untuk nominal uang
            $table->decimal('beras', 8, 2)->nullable(); // Menggunakan decimal untuk beras (misal: 2.5 Kg)

            $table->date('tanggal_penyaluran'); // Tanggal kapan penyaluran dilakukan
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyalurans');
    }
};

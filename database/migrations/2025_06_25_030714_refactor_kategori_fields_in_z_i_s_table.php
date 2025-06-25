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
        Schema::table('z_i_s', function (Blueprint $table) {
                        // 1. Hapus kolom string yang lama
            $table->dropColumn(['kategori_zis', 'jenis_zis']);

            // 2. Tambahkan kolom foreign key yang baru
            $table->foreignId('kategori_zis_id')
                  ->nullable()
                  ->after('rekening_id') // Atur posisi kolom
                  ->constrained('kategori_zis') // Terhubung ke tabel kategori_zis
                  ->onDelete('set null'); // Jika kategori dihapus, nilai di sini jadi NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('z_i_s', function (Blueprint $table) {
                        // Logika untuk membatalkan: hapus kolom baru, kembalikan kolom lama
            $table->dropForeign(['kategori_zis_id']);
            $table->dropColumn('kategori_zis_id');
            $table->string('kategori_zis')->nullable();
            $table->string('jenis_zis')->nullable();
        });
    }
};

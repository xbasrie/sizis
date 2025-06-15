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
            $table->foreignId('rekening_id')
                  ->nullable() // Boleh kosong jika donasi tunai
                  ->after('uang') // Posisi setelah kolom uang
                  ->constrained('rekenings') // Terhubung ke tabel 'rekenings'
                  ->onDelete('set null'); // Jika rekening dihapus, nilai di sini jadi NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('z_i_s', function (Blueprint $table) {
            $table->dropForeign(['rekening_id']);
            $table->dropColumn('rekening_id');
            $table->string('rekening')->nullable();
        });
    }
};

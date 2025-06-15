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
        Schema::table('penyalurans', function (Blueprint $table) {
            $table->foreignId('kategori_zis_id')
              ->nullable()
              ->after('amil_id')
              ->constrained('kategori_zis') // Pastikan nama tabelnya 'kategori_zis'
              ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyalurans', function (Blueprint $table) {
            $table->dropForeign(['kategori_zis_id']);
            $table->dropColumn('kategori_zis_id');
            $table->string('kategori_penyaluran')->nullable();
            $table->string('jenis_penyaluran')->nullable();
        });
    }
};

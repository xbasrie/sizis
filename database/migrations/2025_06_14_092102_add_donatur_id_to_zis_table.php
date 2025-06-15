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
                $table->foreignId('donatur_id')
                  ->after('id') // (Opsional) Menempatkan kolom ini setelah kolom 'id'
                  ->constrained('donaturs')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('z_i_s', function (Blueprint $table) {
            $table->dropForeign(['donatur_id']); // 1. Hapus constraint dulu
            $table->dropColumn('donatur_id'); 
        });
    }
};

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
        Schema::table('amils', function (Blueprint $table) {
            $table->text('alamat')->nullable()->after('nama_amil');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('amils', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'jenis_kelamin']);
        });
    }
};

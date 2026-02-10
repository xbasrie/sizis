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
            $table->string('jenis_donatur')->nullable()->after('nama');
            $table->string('alamat')->nullable()->after('tlp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('z_i_s', function (Blueprint $table) {
            //
        });
    }
};

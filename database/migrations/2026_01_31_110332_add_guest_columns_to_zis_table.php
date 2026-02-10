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
            $table->string('nama')->nullable()->after('campaign_id');
            $table->string('email')->nullable()->after('nama');
            $table->string('tlp')->nullable()->after('email');
            
            // Make donatur_id nullable for guest/online donations
            $table->unsignedBigInteger('donatur_id')->nullable()->change();
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

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
            $table->integer('jiwa')->nullable()->change();
            $table->decimal('beras', 8, 2)->nullable()->change();
            $table->decimal('uang', 15, 2)->nullable()->change();
            $table->text('keterangan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('z_i_s', function (Blueprint $table) {
            $table->integer('jiwa')->nullable(false)->change();
            $table->decimal('beras', 8, 2)->nullable(false)->change();
            $table->decimal('uang', 15, 2)->nullable(false)->change();
            $table->text('keterangan')->nullable(false)->change();
        });
    }
};

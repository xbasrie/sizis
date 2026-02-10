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
            $table->string('order_id')->nullable()->unique()->after('id');
            $table->string('payment_status')->default('success')->after('order_id'); // success, pending, failure, expire
            $table->foreignId('campaign_id')->nullable()->constrained()->nullOnDelete()->after('keterangan');
            $table->string('snap_token')->nullable()->after('campaign_id');
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

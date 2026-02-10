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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('deskripsi');
            $table->bigInteger('target_dana');
            $table->bigInteger('dana_terkumpul')->default(0);
            $table->string('foto')->nullable();
            $table->boolean('status')->default(true); // Active by default
            $table->string('midtrans_link')->nullable(); // Optional, if using payment link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};

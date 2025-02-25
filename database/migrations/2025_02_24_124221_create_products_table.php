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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('nama_product');
            $table->foreignId('kategori_id');
            $table->text('deskripsi');
            $table->double('harga', 10,2);
            $table->string('foto_product');
            $table->enum('status', ['finished', 'available'])->default('finished');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

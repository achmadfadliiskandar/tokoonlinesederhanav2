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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('namaproduk');
            $table->string('gambar');
            $table->string('slug');
            $table->integer('hargabarang');
            $table->integer('stokbarang');
            $table->foreignId('penjual_id');
            $table->foreignId('kategories_id')->nullable();
            $table->foreign('penjual_id')->references('id')->on('penjuals')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('kondisibarang')->nullable();
            $table->foreignId('user_id');//penjual
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};

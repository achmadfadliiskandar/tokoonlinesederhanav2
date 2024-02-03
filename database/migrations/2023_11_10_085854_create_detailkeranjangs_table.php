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
        Schema::create('detailkeranjangs', function (Blueprint $table) {
            $table->id();
            $table->integer("keranjangs_id");
            $table->integer("transaksis_id");
            // penjual
            $table->foreignId("penjuals_id");
            $table->foreign('penjuals_id')->references('id')->on('penjuals')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // penjual
            $table->string("statustransaksi");
            // barang
            $table->foreignId("barangs_id");
            $table->foreign('barangs_id')->references('id')->on('barangs')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // barang
            $table->integer("stok");
            // pembeli
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // pembeli
            $table->string("kodebayar");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailkeranjangs');
    }
};

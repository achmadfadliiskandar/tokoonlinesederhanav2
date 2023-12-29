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
        Schema::create('penjuals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('namatoko');
            $table->string('alamattoko');
            $table->string('kodepos')->nullable();
            $table->string('cabangtoko')->nullable();
            $table->string('modaltoko')->nullable();
            $table->string('tahunbuka')->nullable();
            $table->string('nomorrekening');
            $table->string('slug');
            $table->string('photo')->nullable();
            $table->integer('bank_id');
            // $table->enum('metodepembayaran',['fleksibel','online','cash']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjuals');
    }
};

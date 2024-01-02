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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_member');
            $table->string('invoice');
            $table->integer('grand_total');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('pesanan_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pesanan');
            $table->integer('id_barang');
            $table->integer('jumlah');
            $table->string('size');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};

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
            $table->integer('id_kategori');
            $table->integer('id_subkategori');
            $table->string('kode');
            $table->string('namabarang');
            $table->string('harga');
            $table->string('stok');
            $table->unsignedBigInteger('satuan_id');
            $table->string('ukuran');
            $table->text('deskripsi');
            $table->string('gambar');
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

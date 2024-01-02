<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       for ($i=1; $i <= 20; $i++) { 
            Barang::create([
                'id_kategori' => rand(18, 20),
                'id_subkategori' => rand(5, 24),
                'kode' => rand(100, 150),
                'namabarang' => 'Lorem Ipsum Dolor Sit Amet',
                'harga' => rand(50000, 150000),
                'stok' => rand(50, 100),
                'satuan_id' => rand(118, 120),
                'ukuran' => 'S,M,L,XL,XXL',
                'deskripsi' => 'Lorem Ipsum Dolor Sit Amet',
                'gambar' => 'jersey_image_' . $i . '.jpg'
            ]);
       } 
    }
}

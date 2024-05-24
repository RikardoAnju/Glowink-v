<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            product::create([
                'id_kategori' => rand(1, 3),
                'id_subkategori' => rand(1,4),
                'nama_barang' => 'Lorem Ipsun Dolor',
                'harga' =>rand(10000, 10000),
                'diskon' => 0,
                'bahan' => 'Lorem Ipsum',
                'sku' => Str::random(8),
                'gambar' => 'shop_image_' . $i . '.jpg' ,
                'deskripsi'=> 'Lorem impsum the jou'
            ]);
        }
    }
}

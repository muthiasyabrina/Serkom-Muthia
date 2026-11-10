<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'nama_produk' => 'Kopi Ulee Kareng Original',
                'deskripsi' =>'Kopi khas Aceh dengan aroma kuat.',
                'harga' => 15000,
                'gambar' => 'kopi-original.jpg',
            ],
            [
                'nama_produk' => 'Kopi Sanger',
                'deskripsi' =>'Perpaduan kopi dan susu yang lembut.',
                'harga' => 20000,
                'gambar' => 'kopi-sanger.jpg',
            ],
            [
                'nama_produk' => 'Kopi Tubruk Aceh',
                'deskripsi' =>'Sajian tradisional dengan rasa pekat.',
                'harga' => 13000,
                'gambar' => 'kopi-tubruk.jpg',
            ],
        ];

        foreach ($products as $product) {
            product::query()->create($product);
        }
    }
}


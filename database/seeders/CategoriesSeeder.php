<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Makanan Ringan',
                'description' => 'Kategori untuk makanan ringan',
                'image' => 'makanan_ringan.jpg',
            ],
            [
                'name' => 'Minuman Botol',
                'description' => 'Kategori untuk minuman botol',
                'image' => 'minuman_botol.jpg',
            ],
            [
                'name' => 'Produk Kesehatan dan Kebersihan',
                'description' => 'Kategori untuk produk kesehatan dan kebersihan',
                'image' => 'kesehatan_kebersihan.jpg',
            ],
            [
                'name' => 'Bumbu Dapur',
                'description' => 'Kategori untuk bumbu dapur',
                'image' => 'bumbu_dapur.jpg',
            ],
            [
                'name' => 'Snack dan Cemilan',
                'description' => 'Kategori untuk snack dan cemilan',
                'image' => 'snack_cemilan.jpg',
            ],
            [
                'name' => 'Produk Susu dan Olahan Susu',
                'description' => 'Kategori untuk produk susu dan olahan susu',
                'image' => 'susu_olahan.jpg',
            ],
            [
                'name' => 'Minuman Sachet',
                'description' => 'Kategori untuk minuman sachet',
                'image' => 'minuman_sachet.jpg',
            ],
            [
                'name' => 'Produk Pembersih Rumah Tangga',
                'description' => 'Kategori untuk produk pembersih rumah tangga',
                'image' => 'pembersih_rumah_tangga.jpg',
            ],
            [
                'name' => 'Kecap, Saus, dan Bumbu Masak',
                'description' => 'Kategori untuk kecap, saus, dan bumbu masak',
                'image' => 'kecap_saus_bumbu_masak.jpg',
            ],
            [
                'name' => 'Produk Perawatan Pribadi',
                'description' => 'Kategori untuk produk perawatan pribadi',
                'image' => 'perawatan_pribadi.jpg',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}

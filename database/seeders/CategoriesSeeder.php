<?php

namespace Database\Seeders;

use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        $data = [
            [
                'name' => 'Makanan Ringan',
                'description' => 'Kategori untuk makanan ringan',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
            [
                'name' => 'Minuman Botol',
                'description' => 'Kategori untuk minuman botol',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
            [
                'name' => 'Produk Kesehatan dan Kebersihan',
                'description' => 'Kategori untuk produk kesehatan dan kebersihan',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
            [
                'name' => 'Bumbu Dapur',
                'description' => 'Kategori untuk bumbu dapur',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
            [
                'name' => 'Snack dan Cemilan',
                'description' => 'Kategori untuk snack dan cemilan',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
            [
                'name' => 'Produk Susu dan Olahan Susu',
                'description' => 'Kategori untuk produk susu dan olahan susu',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
            [
                'name' => 'Minuman Sachet',
                'description' => 'Kategori untuk minuman sachet',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
            [
                'name' => 'Produk Pembersih Rumah Tangga',
                'description' => 'Kategori untuk produk pembersih rumah tangga',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
            [
                'name' => 'Kecap, Saus, dan Bumbu Masak',
                'description' => 'Kategori untuk kecap, saus, dan bumbu masak',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
            [
                'name' => 'Produk Perawatan Pribadi',
                'description' => 'Kategori untuk produk perawatan pribadi',
                'image' => 'https://img2.pngdownload.id/20180206/qoe/kisspng-popcorn-food-icon-yellow-popcorn-5a7a7951e4a064.1551013515179758899365.jpg',
            ],
        ];
        $client = new Client();
        foreach ($data as $item) {
            $response = $client->request('GET', $item['image']);
            $extension = pathinfo($item['image'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;
            Storage::put('public/assets/image/' . $imageName, $response->getBody());
            $item['image'] = $imageName;

            DB::table('categories')->insert(
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'image' => 'assets/image/'.$item['image'],
                ]
            );
        }

    }
}

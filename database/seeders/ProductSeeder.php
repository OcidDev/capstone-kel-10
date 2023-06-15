<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = [
            [
                'shelves_id' => 1,
                'categories_id' => 1,
                'name' => 'Chitato',
                'image' => 'chitato.jpg',
                'product_code' => 'PR-202306001',
                'description' => 'Makanan Ringan',
                'price' => 5000,
                'capital_price' => 4000,
            ],
            [
                'shelves_id' => 1,
                'categories_id' => 1,
                'name' => 'Oreo',
                'image' => 'oreo.jpg',
                'product_code' => 'PR-202306002',
                'description' => 'Makanan Ringan',
                'price' => 5000,
                'capital_price' => 4000,

            ],
            [
                'shelves_id' => 2,
                'categories_id' => 2,
                'name' => 'Aqua',
                'image' => 'aqua.jpg',
                'product_code' => 'PR-202306003',
                'description' => 'Minuman Botol',
                'price' => 5000,
                'capital_price' => 4000,
            ],
            [
                'shelves_id' => 2,
                'categories_id' => 2,
                'name' => 'Coca Cola',
                'image' => 'coca_cola.jpg',
                'product_code' => 'PR-202306004',
                'description' => 'Minuman Botol',
                'price' => 5000,
                'capital_price' => 4000,
            ],
        ];

        DB::table('products')->insert($products);
    }
}

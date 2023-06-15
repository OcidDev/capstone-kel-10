<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShelvesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shelves = [
            [
                'name' => 'Rak 1',
                'description' => 'Rak untuk menyimpnan minuman',
            ],
            [
                'name' => 'Rak 2',
                'description' => 'Rak untuk menyimpan makanan',
            ],
            [
                'name' => 'Rak 3',
                'description' => 'Rak untuk menyimpan barang-barang kebersihan',
            ],
            [
                'name' => 'Rak 4',
                'description' => 'Rak untuk menyimpan barang-barang dapur',
            ],
            [
                'name' => 'Rak 5',
                'description' => 'Rak untuk menyimpan barang rumah tangga',
            ],
        ];

        DB::table('shelves')->insert($shelves);
    }
}

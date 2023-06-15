<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BuyerrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buyers = [
            [
                'name' => 'Salsabila',
                'email' => 'salsabila@gmail.com',
                'phone' => '088218530051',
                'address' => 'Surakarta',
            ],
            [
                'name' => 'Yohanes',
                'email' => 'yohanes@gmail.com',
                'phone' => '088218530051',
                'address' => 'Jakarta',
            ],
            [
                'name' => 'Viki',
                'email' => 'viki@gmail.com',
                'phone' => '088218530051',
                'address' => 'Cirebon',
            ],

        ];

        DB::table('buyers')->insert($buyers);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'name' => 'Luthfia',
                'phone' => '088218530051',
                'address' => 'Sidoarjo',
            ],
            [
                'name' => 'Ocid',
                'phone' => '089532423423',
                'address' => 'Cirebon',
            ],
            [
                'name' => 'Fahreza',
                'phone' => '082234234234',
                'address' => 'Surabaya',
            ],
            [
                'name' => 'Tyan',
                'phone' => '087742342342',
                'address' => 'Surabaya',
            ],
            [
                'name' => 'Ifan',
                'phone' => '087742342342',
                'address' => 'Purwokerto',
            ],
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}

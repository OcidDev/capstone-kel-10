<?php

namespace Database\Seeders;

use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        $data = [
            [
                'shelves_id' => 1,
                'categories_id' => 1,
                'name' => 'Chitato',
                'image' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiIRVxw9aM2KmZn66rVfXGQLO6xqgAct-qgnUsAjQUfhka4zqLEstnO3okUCd_IaS_wzYUoAawvgFSrZBl_tYfdYU2INP1gx3gqNlBk4z4F_l4cQZJHVp-63fannap9IC4cwwU109A4-HFOqa-OntUiYb-rLB4m5CAKkr-wasLURfCzgjJhRGVaBNGw0evh/s625/CHITATO.png',
                'product_code' => 'PR-202306001',
                'description' => 'Makanan Ringan',
                'price' => 5000,
                'capital_price' => 4000,
            ],
            [
                'shelves_id' => 1,
                'categories_id' => 1,
                'name' => 'Oreo',
                'image' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhKR7-o3QeddA9me3V696K-Ie1cm-9B02_oh_WRGQq_Dn4lGj-dYPe-EL60PZtbNk9irnM5JexeAsQWoMLh6Ud5UMC_hP-ujnpbHgGuAGfeu4X8--Rccj7jcM4_6bNvGF5qohWYHtzZfSiG3-WHIlR-XvWhByQ804PgKEoE-hofyDNoz-EY52smQZk35dpi/s625/OREO.png',
                'product_code' => 'PR-202306002',
                'description' => 'Makanan Ringan',
                'price' => 5000,
                'capital_price' => 4000,

            ],
            [
                'shelves_id' => 2,
                'categories_id' => 2,
                'name' => 'Aqua',
                'image' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgViI1o5CiJsncCvO42q7hUCq9GHzkkfLUVh5szeNaVooz1fjL27eEU2J_WGEOtToKwun7GW_Ii0dnCaP_f75UlkLRM3PZLMsJhhKMO7QKFamDe4xb4yplOYx70YQuQbidejvzJUPToUNBqxVaU4TlBAmtTb-vMnveaG0hqoVpYXMWy2SJRDNknRkZGamyZ/s625/AQUA.png',
                'product_code' => 'PR-202306003',
                'description' => 'Minuman Botol',
                'price' => 5000,
                'capital_price' => 4000,
            ],
            [
                'shelves_id' => 2,
                'categories_id' => 2,
                'name' => 'Coca Cola',
                'image' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiMhFKzycZwWeax6sd7USVnkXPFR62TQytW598vmmTVgmnXP1Jk5Mel3OEGtTmJJcQhzdtuFJIq-5L0u7lmXBzyD3FfyFeWEJbRa68tJZb_yQKqGNliNMAfHgUuZirey8SpElNTgOeY8f6gpXJqE4ctNCD8Lb5BzBNQ-MJRqiC2w4c0yVDG0ACps7uXWpY1/s625/COCA%20COLA.png',
                'product_code' => 'PR-202306004',
                'description' => 'Minuman Botol',
                'price' => 5000,
                'capital_price' => 4000,
            ],
        ];

        $client = new Client();
        foreach ($data as $item) {
            $response = $client->request('GET', $item['image']);
            $extension = pathinfo($item['image'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;
            Storage::put('public/assets/image/' . $imageName, $response->getBody());
            $item['image'] = $imageName;

            DB::table('products')->insert(
                [
                    'shelves_id' => $item['shelves_id'],
                    'categories_id' => $item['categories_id'],
                    'name' => $item['name'],
                    'image' => 'assets/image/'.$item['image'],
                    'product_code' => $item['product_code'],
                    'price' => $item['price'],
                    'capital_price' => $item['capital_price'],
                ]
            );
        }
    }
}

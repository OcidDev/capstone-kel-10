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
                'image' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjK6RxXaOXoyCUR0jv0FnndZFbsMOFu2v-LrNGoPXJQnj6ENO_GiN8t1J7hF4IFxs2v4MB70zVmrXweO828tpqq_nHboGux_1ixz-ChiAvsU9ri7N-S9lWW_TB1-2PIWMTJO14kGJBRu2vD2LbTCg6Vp8uZ9iy65oSnC6ypxHXbjMJAWyZIWHt3VxtIoTd3/s625/Untitled-1.png',
            ],
            [
                'name' => 'Minuman Botol',
                'description' => 'Kategori untuk minuman botol',
                'image' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEj2Az039W1aKH0CIKA6kY5Ev_ZyRKnVYQii9AW2j8tyNItrYjT1GZmwSyuAIhlGX-RvBYj-hPNQw6_zUB6guxbpeKFj8ML6prpU-85Dq3dEvf470uEC6-Rr9C92fCG2EpwriOJMu9kfLKWri0PwiYzXXkRoPHFRAcc29Tthb_nrGOTpkwPedHG7JHaVKw2B/s625/icon%20minuman%20botol.png',
            ],
            [
                'name' => 'Kesehatan dan Kebersihan',
                'description' => 'Kategori untuk produk kesehatan dan kebersihan',
                'image' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEg5HykUVOVjH65LFd3y_FmlppLpD3Tici7T-7TAVPmKKxQWm70ote8_dnyRzLnTyf9QcDmM7pImTydrvD72ZkiT-CheqMtLUTU3WRbnIeIlbIWdYDwDNF6sCeLtrg23afz3HB1LI_WwmRN5k2t3U4kNl8AtRYSe81sMFox4_75OErmkw_RDCPZ76d7UdzWw/s625/produk%20kebersihan.png',
            ],
            [
                'name' => 'Bumbu Dapur',
                'description' => 'Kategori untuk bumbu dapur',
                'image' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjrGkKAZlLwDfLtxOo9mEmDGirFAYUskUit-7SWTZP0Nc78UQYsrbzku3iXZUiiT6-XezPBUi51EOReooxzbKqhJcTpFLxHbdToMfVv03yGh0HOZMMWOQjG8v9V9V6a2u10VFio9F3iYbqX225YkWj2gynLstu0vj7Lv6jS2R32YS3NR9wVvA6bR5x7PZ0s/s625/bumbu%20dapur.png',
            ],
            [
                'name' => 'Produk Kecantikan',
                'description' => 'Kategori untuk produk perawatan pribadi',
                'image' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEijE427Z22AQiiqHwYANTXWsdyQnqos6rOUaQM4FwZx_soKvxlCGHrdzWkLK6dbXNxRruIBqWLg0qr9NWwr0FchYpWA38AJEMbnNLfOBCGoT44Hjc6EglKW7u20v-AWehJOrnkLwIUKpU6ug0EigU8d5LMyS9JLnyo2bGcjb7W1DY4ukIFrcUoiK8jLfVgK/s625/produk_kecantikan.png',
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

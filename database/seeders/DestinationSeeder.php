<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'category_id' => 2, // Wisata Pantai
                'name' => 'Pantai Papuma',
                'description' => 'Pantai Papuma atau Pasir Putih Malikan adalah salah satu destinasi wisata pantai terindah di Jember. Pantai ini terkenal dengan pasir putihnya yang bersih dan batuan karang yang unik.',
                'address' => 'Desa Lojejer, Kecamatan Wuluhan, Kabupaten Jember',
                'latitude' => -8.430641,
                'longitude' => 113.579583,
                'entry_fee' => 15000,
                'opening_hours' => '07:00 - 17:00',
                'facilities' => ['Parkir', 'Toilet', 'Warung Makan', 'Gazebo', 'Spot Foto'],
                'is_featured' => true
            ],
            [
                'category_id' => 1, // Wisata Alam
                'name' => 'Air Terjun Tancak',
                'description' => 'Air Terjun Tancak merupakan air terjun dengan ketinggian sekitar 100 meter yang terletak di lereng Gunung Argopuro.',
                'address' => 'Desa Suci, Kecamatan Panti, Kabupaten Jember',
                'latitude' => -8.058209,
                'longitude' => 113.707361,
                'entry_fee' => 10000,
                'opening_hours' => '08:00 - 16:00',
                'facilities' => ['Parkir', 'Toilet', 'Warung', 'Area Camping'],
                'is_featured' => true
            ],
            [
                'category_id' => 3, // Wisata Kuliner
                'name' => 'Warung Pempek Jember',
                'description' => 'Warung yang menyajikan pempek khas Jember dengan berbagai varian dan sambal cuko yang autentik.',
                'address' => 'Jl. Mastrip No.45, Jember',
                'latitude' => -8.172679,
                'longitude' => 113.702431,
                'opening_hours' => '09:00 - 21:00',
                'facilities' => ['Parkir', 'Wifi', 'Toilet'],
                'is_featured' => false
            ]
        ];

        foreach ($destinations as $destination) {
            Destination::create([
                'category_id' => $destination['category_id'],
                'name' => $destination['name'],
                'slug' => Str::slug($destination['name']),
                'description' => $destination['description'],
                'address' => $destination['address'],
                'latitude' => $destination['latitude'],
                'longitude' => $destination['longitude'],
                'entry_fee' => $destination['entry_fee'] ?? null,
                'opening_hours' => $destination['opening_hours'] ?? null,
                'facilities' => $destination['facilities'] ?? null,
                'is_featured' => $destination['is_featured'] ?? false
            ]);
        }
    }
}

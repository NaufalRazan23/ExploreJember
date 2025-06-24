<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Wisata Alam',
                'description' => 'Destinasi wisata alam yang memukau di Kabupaten Jember',
                'icon' => 'nature'
            ],
            [
                'name' => 'Wisata Pantai',
                'description' => 'Pantai-pantai indah di sepanjang pesisir Jember',
                'icon' => 'beach'
            ],
            [
                'name' => 'Wisata Kuliner',
                'description' => 'Destinasi kuliner khas Jember yang menggugah selera',
                'icon' => 'food'
            ],
            [
                'name' => 'Wisata Budaya',
                'description' => 'Destinasi wisata yang kaya akan nilai budaya dan sejarah',
                'icon' => 'culture'
            ],
            [
                'name' => 'Wisata Edukasi',
                'description' => 'Tempat wisata yang memberikan nilai edukasi',
                'icon' => 'education'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'icon' => $category['icon']
            ]);
        }
    }
}

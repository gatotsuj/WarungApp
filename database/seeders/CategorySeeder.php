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
        //
        $categories = [
            [
                'name' => 'Makanan',
                'description' => 'Berbagai macam makanan siap saji dan bahan makanan',
            ],
            [
                'name' => 'Minuman',
                'description' => 'Minuman dingin, panas, dan kemasan',
            ],
            [
                'name' => 'Snack',
                'description' => 'Cemilan dan makanan ringan',
            ],
            [
                'name' => 'Kebutuhan Rumah',
                'description' => 'Sabun, deterjen, dan kebutuhan rumah tangga',
            ],
            [
                'name' => 'Rokok',
                'description' => 'Berbagai merk rokok',
            ],
            [
                'name' => 'Pulsa & Token',
                'description' => 'Pulsa elektrik dan token listrik',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => true,
            ]);
        }
    }
}

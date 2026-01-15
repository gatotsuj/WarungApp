<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = [
            // Makanan
            ['category' => 'Makanan', 'name' => 'Indomie Goreng', 'price' => 3500, 'stock' => 100],
            ['category' => 'Makanan', 'name' => 'Indomie Kuah Soto', 'price' => 3500, 'stock' => 80],
            ['category' => 'Makanan', 'name' => 'Mie Sedaap Goreng', 'price' => 3500, 'stock' => 60],
            ['category' => 'Makanan', 'name' => 'Nasi Bungkus', 'price' => 10000, 'stock' => 20],
            ['category' => 'Makanan', 'name' => 'Telur Ayam (per butir)', 'price' => 2500, 'stock' => 200],

            // Minuman
            ['category' => 'Minuman', 'name' => 'Aqua 600ml', 'price' => 4000, 'stock' => 150],
            ['category' => 'Minuman', 'name' => 'Teh Botol Sosro', 'price' => 5000, 'stock' => 80],
            ['category' => 'Minuman', 'name' => 'Es Teh Pucuk Harum', 'price' => 4000, 'stock' => 90],
            ['category' => 'Minuman', 'name' => 'Kopi Kapal Api Sachet', 'price' => 2000, 'stock' => 100],
            ['category' => 'Minuman', 'name' => 'Susu Ultra 250ml', 'price' => 6000, 'stock' => 40],
            ['category' => 'Minuman', 'name' => 'Pocari Sweat 350ml', 'price' => 8000, 'stock' => 35],

            // Snack
            ['category' => 'Snack', 'name' => 'Chitato 68gr', 'price' => 12000, 'stock' => 30],
            ['category' => 'Snack', 'name' => 'Qtela Singkong', 'price' => 10000, 'stock' => 35],
            ['category' => 'Snack', 'name' => 'Oreo 137gr', 'price' => 10000, 'stock' => 40],
            ['category' => 'Snack', 'name' => 'Taro Net', 'price' => 3000, 'stock' => 60],
            ['category' => 'Snack', 'name' => 'Chiki Balls', 'price' => 2500, 'stock' => 70],
            ['category' => 'Snack', 'name' => 'Beng Beng', 'price' => 3000, 'stock' => 50],

            // Kebutuhan Rumah
            ['category' => 'Kebutuhan Rumah', 'name' => 'Rinso Sachet', 'price' => 1500, 'stock' => 100],
            ['category' => 'Kebutuhan Rumah', 'name' => 'Sabun Lifebuoy', 'price' => 4000, 'stock' => 50],
            ['category' => 'Kebutuhan Rumah', 'name' => 'Sunlight Sachet', 'price' => 1000, 'stock' => 120],
            ['category' => 'Kebutuhan Rumah', 'name' => 'Pasta Gigi Pepsodent', 'price' => 8000, 'stock' => 30],
            ['category' => 'Kebutuhan Rumah', 'name' => 'Baygon Semprot', 'price' => 35000, 'stock' => 15],

            // Rokok
            ['category' => 'Rokok', 'name' => 'Gudang Garam Filter 12', 'price' => 28000, 'stock' => 50],
            ['category' => 'Rokok', 'name' => 'Djarum Super 12', 'price' => 25000, 'stock' => 40],
            ['category' => 'Rokok', 'name' => 'Sampoerna Mild 16', 'price' => 32000, 'stock' => 35],
            ['category' => 'Rokok', 'name' => 'Surya Pro Mild', 'price' => 22000, 'stock' => 45],

            // Pulsa & Token
            ['category' => 'Pulsa & Token', 'name' => 'Pulsa 10.000', 'price' => 12000, 'stock' => 999],
            ['category' => 'Pulsa & Token', 'name' => 'Pulsa 25.000', 'price' => 27000, 'stock' => 999],
            ['category' => 'Pulsa & Token', 'name' => 'Pulsa 50.000', 'price' => 52000, 'stock' => 999],
            ['category' => 'Pulsa & Token', 'name' => 'Token Listrik 50.000', 'price' => 52000, 'stock' => 999],
            ['category' => 'Pulsa & Token', 'name' => 'Token Listrik 100.000', 'price' => 102000, 'stock' => 999],
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category'])->first();

            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name']),
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'is_active' => true,
                ]);
            }
        }
    }
}

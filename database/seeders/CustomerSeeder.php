<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            'DKI Jakarta',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'Bali',
            'Sumatera Utara',
            'Sumatera Barat',
            'Sulawesi Selatan',
            'Kalimantan Timur',
            'Papua',
        ];

        $cities = [
            'Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Barat', 'Jakarta Utara',
            'Bandung', 'Bogor', 'Depok', 'Bekasi', 'Tangerang',
            'Semarang', 'Solo', 'Yogyakarta', 'Magelang',
            'Surabaya', 'Malang', 'Sidoarjo', 'Gresik',
            'Denpasar', 'Badung', 'Gianyar',
            'Medan', 'Padang', 'Makassar', 'Balikpapan', 'Jayapura',
        ];

        $types = ['retail', 'wholesale', 'corporate'];

        for ($i = 1; $i <= 50; $i++) {
            $type = $types[array_rand($types)];
            $city = $cities[array_rand($cities)];
            $province = $provinces[array_rand($provinces)];

            Customer::create([
                'code' => 'CUST-'.str_pad($i, 5, '0', STR_PAD_LEFT),
                'name' => $this->generateName($type),
                'email' => 'customer'.$i.'@example.com',
                'phone' => '08'.rand(1000000000, 9999999999),
                'address' => 'Jl. '.$this->generateStreetName().' No. '.rand(1, 999),
                'city' => $city,
                'province' => $province,
                'postal_code' => rand(10000, 99999),
                'type' => $type,
                'is_active' => rand(0, 10) > 1, // 90% aktif
            ]);
        }
    }

    private function generateName($type): string
    {
        $retailNames = [
            'Ahmad Wijaya', 'Budi Santoso', 'Citra Dewi', 'Dian Purnomo', 'Eka Saputra',
            'Fitri Handayani', 'Gita Permata', 'Hendra Kusuma', 'Indah Lestari', 'Joko Widodo',
            'Kartika Sari', 'Linda Wijayanti', 'Maya Sari', 'Nanda Pratama', 'Okta Ramadhan',
        ];

        $wholesaleNames = [
            'Toko Sejahtera', 'Toko Maju Jaya', 'Toko Berkah', 'Toko Rezeki',
            'Toko Bahagia', 'Toko Sumber Rejeki', 'Toko Lancar Jaya', 'Toko Murni',
            'Toko Sentosa', 'Toko Abadi',
        ];

        $corporateNames = [
            'PT Maju Bersama', 'PT Sejahtera Abadi', 'PT Karya Prima', 'PT Nusantara Jaya',
            'PT Indo Sukses', 'PT Mega Berkah', 'PT Cahaya Terang', 'PT Sumber Makmur',
            'PT Teknologi Maju', 'PT Global Indonesia', 'CV Mandiri Jaya', 'CV Gemilang',
        ];

        return match ($type) {
            'retail' => $retailNames[array_rand($retailNames)],
            'wholesale' => $wholesaleNames[array_rand($wholesaleNames)],
            'corporate' => $corporateNames[array_rand($corporateNames)],
            default => 'Customer '.rand(1, 999)
        };
    }

    private function generateStreetName(): string
    {
        $streets = [
            'Merdeka', 'Sudirman', 'Gatot Subroto', 'Diponegoro', 'Ahmad Yani',
            'Veteran', 'Raya Pahlawan', 'Proklamasi', 'Pemuda', 'Kartini',
            'Gajah Mada', 'Hayam Wuruk', 'Thamrin', 'Kebon Jeruk', 'Mangga Dua',
        ];

        return $streets[array_rand($streets)];
    }
}

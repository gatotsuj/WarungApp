<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Jakarta', 'Bandung', 'Surabaya', 'Semarang', 'Yogyakarta',
            'Medan', 'Makassar', 'Palembang', 'Tangerang', 'Depok',
            'Bekasi', 'Bogor', 'Malang', 'Denpasar', 'Balikpapan',
        ];

        $paymentTerms = ['cash', 'credit_7', 'credit_14', 'credit_30', 'credit_45', 'credit_60'];

        $supplierNames = [
            'PT Sumber Rejeki', 'PT Mitra Sejahtera', 'PT Cahaya Abadi', 'PT Karya Prima',
            'PT Indo Makmur', 'PT Nusantara Jaya', 'PT Berkah Sentosa', 'PT Mega Supplier',
            'CV Jaya Mandiri', 'CV Sukses Bersama', 'CV Maju Lancar', 'CV Sentosa Abadi',
            'UD Sumber Barokah', 'UD Rezeki Lancar', 'UD Berkah Jaya', 'UD Mandiri Sejahtera',
            'PT Global Trading', 'PT Asia Pacific', 'PT Multi Guna', 'PT Sarana Utama',
            'PT Surya Mandiri', 'PT Bintang Terang', 'PT Harapan Jaya', 'PT Wijaya Kusuma',
            'CV Anugrah Jaya', 'CV Putra Mandiri', 'CV Sejahtera Makmur', 'CV Bangun Jaya',
            'PT Prima Sejahtera', 'PT Cipta Karya', 'PT Duta Pertiwi', 'PT Eka Jaya',
            'PT Fajar Cemerlang', 'PT Gemilang Abadi', 'PT Harmoni Sejahtera', 'PT Indah Karya',
            'CV Jaya Abadi', 'CV Karya Bersama', 'CV Lancar Jaya', 'CV Mitra Usaha',
            'UD Nusa Jaya', 'UD Obor Berkat', 'UD Permata Indah', 'UD Quantum Rezeki',
            'PT Rajawali Sakti', 'PT Surya Gemilang', 'PT Tirta Megah', 'PT Usaha Maju',
            'PT Virgo Jaya', 'PT Wira Sakti',
        ];

        $contactNames = [
            'Budi Santoso', 'Ahmad Wijaya', 'Siti Nurhaliza', 'Eko Prasetyo', 'Dewi Lestari',
            'Hendra Gunawan', 'Rina Wati', 'Agus Setiawan', 'Linda Kusuma', 'Doni Pratama',
            'Maya Sari', 'Rudi Hartono', 'Fitri Handayani', 'Joko Susilo', 'Ani Rahayu',
            'Bambang Suryanto', 'Citra Dewi', 'Adi Nugroho', 'Sri Wahyuni', 'Yanto Wijaya',
        ];

        for ($i = 1; $i <= 50; $i++) {
            $city = $cities[array_rand($cities)];
            $paymentTerm = $paymentTerms[array_rand($paymentTerms)];
            $supplierName = $supplierNames[$i - 1];
            $contactName = $contactNames[array_rand($contactNames)];

            Supplier::create([
                'code' => 'SUP-'.str_pad($i, 5, '0', STR_PAD_LEFT),
                'name' => $supplierName,
                'contact_person' => $contactName,
                'email' => strtolower(str_replace([' ', '.'], ['', ''], explode(' ', $supplierName)[1] ?? 'supplier')).$i.'@example.com',
                'phone' => '021-'.rand(1000000, 9999999),
                'address' => 'Jl. '.$this->generateStreetName().' No. '.rand(1, 250).', '.$this->generateArea(),
                'city' => $city,
                'tax_number' => $this->generateTaxNumber(),
                'payment_term' => $paymentTerm,
                'is_active' => rand(0, 10) > 1, // 90% aktif
            ]);
        }
    }

    private function generateStreetName(): string
    {
        $streets = [
            'Raya Industri', 'Boulevard', 'Gatot Subroto', 'Sudirman', 'Thamrin',
            'HR Rasuna Said', 'MT Haryono', 'Yos Sudarso', 'Ahmad Yani', 'Diponegoro',
            'Gajah Mada', 'Hayam Wuruk', 'Veteran', 'Merdeka', 'Pahlawan',
        ];

        return $streets[array_rand($streets)];
    }

    private function generateArea(): string
    {
        $areas = [
            'Kelapa Gading', 'Kemayoran', 'Sunter', 'Pademangan', 'Tanjung Priok',
            'Cempaka Putih', 'Menteng', 'Tanah Abang', 'Kebayoran', 'Pondok Indah',
            'Kuningan', 'Setiabudi', 'Tebet', 'Pasar Minggu', 'Cilandak',
        ];

        return $areas[array_rand($areas)];
    }

    private function generateTaxNumber(): string
    {
        // Format NPWP: 00.000.000.0-000.000
        return sprintf(
            '%02d.%03d.%03d.%d-%03d.%03d',
            rand(1, 99),
            rand(100, 999),
            rand(100, 999),
            rand(1, 9),
            rand(100, 999),
            rand(100, 999)
        );
    }
}

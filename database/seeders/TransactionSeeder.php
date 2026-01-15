<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $customers = [
            ['name' => 'Budi Santoso', 'phone' => '081234567890'],
            ['name' => 'Siti Rahayu', 'phone' => '082345678901'],
            ['name' => 'Ahmad Hidayat', 'phone' => '083456789012'],
            ['name' => 'Dewi Lestari', 'phone' => '084567890123'],
            ['name' => 'Eko Prasetyo', 'phone' => '085678901234'],
            ['name' => 'Rina Wati', 'phone' => '086789012345'],
            ['name' => 'Joko Widodo', 'phone' => '087890123456'],
            ['name' => 'Sri Mulyani', 'phone' => '088901234567'],
        ];

        $statuses = ['pending', 'processing', 'completed', 'completed', 'completed'];
        $products = Product::all();

        // Buat 20 transaksi
        for ($i = 0; $i < 20; $i++) {
            $customer = $customers[array_rand($customers)];
            $status = $statuses[array_rand($statuses)];

            // Random date dalam 7 hari terakhir
            $createdAt = Carbon::now()->subDays(rand(0, 7))->subHours(rand(0, 23));

            $transaction = Transaction::create([
                'code' => 'TRX-'.$createdAt->format('Ymd').'-'.str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'customer_name' => $customer['name'],
                'customer_phone' => $customer['phone'],
                'status' => $status,
                'total_amount' => 0,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Random 1-5 items per transaksi
            $itemCount = rand(1, 5);
            $selectedProducts = $products->random($itemCount);
            $totalAmount = 0;

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 3);
                $subtotal = $product->price * $quantity;
                $totalAmount += $subtotal;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            // Update total amount
            $transaction->update(['total_amount' => $totalAmount]);
        }
    }
}

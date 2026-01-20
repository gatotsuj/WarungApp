<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $accounts = [
            // ========== ASET (1-XXXX) ==========
            [
                'code' => '1-0000',
                'name' => 'ASET',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],

            // Aset Lancar
            [
                'code' => '1-1000',
                'name' => 'Aset Lancar',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '1-1001',
                'name' => 'Kas',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'is_cash_account' => true,
                'parent_id' => null,
            ],
            [
                'code' => '1-1002',
                'name' => 'Kas Kecil',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'is_cash_account' => true,
                'parent_id' => null,
            ],
            [
                'code' => '1-1100',
                'name' => 'Bank',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'is_bank_account' => true,
                'parent_id' => null,
            ],
            [
                'code' => '1-1101',
                'name' => 'Bank BCA',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'is_bank_account' => true,
                'parent_id' => null,
            ],
            [
                'code' => '1-1102',
                'name' => 'Bank Mandiri',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'is_bank_account' => true,
                'parent_id' => null,
            ],
            [
                'code' => '1-1200',
                'name' => 'Piutang Usaha',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '1-1300',
                'name' => 'Persediaan Barang Dagang',
                'type' => 'asset',
                'subtype' => 'inventory',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '1-1400',
                'name' => 'Uang Muka Pembelian',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '1-1500',
                'name' => 'PPN Masukan',
                'type' => 'asset',
                'subtype' => 'current_asset',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],

            // Aset Tetap
            [
                'code' => '1-2000',
                'name' => 'Aset Tetap',
                'type' => 'asset',
                'subtype' => 'fixed_asset',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '1-2001',
                'name' => 'Peralatan Toko',
                'type' => 'asset',
                'subtype' => 'fixed_asset',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '1-2002',
                'name' => 'Kendaraan',
                'type' => 'asset',
                'subtype' => 'fixed_asset',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '1-2100',
                'name' => 'Akumulasi Penyusutan',
                'type' => 'asset',
                'subtype' => 'fixed_asset',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],

            // ========== KEWAJIBAN (2-XXXX) ==========
            [
                'code' => '2-0000',
                'name' => 'KEWAJIBAN',
                'type' => 'liability',
                'subtype' => 'current_liability',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],

            // Kewajiban Lancar
            [
                'code' => '2-1000',
                'name' => 'Kewajiban Lancar',
                'type' => 'liability',
                'subtype' => 'current_liability',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],
            [
                'code' => '2-1001',
                'name' => 'Utang Usaha',
                'type' => 'liability',
                'subtype' => 'current_liability',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],
            [
                'code' => '2-1100',
                'name' => 'Utang Gaji',
                'type' => 'liability',
                'subtype' => 'current_liability',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],
            [
                'code' => '2-1200',
                'name' => 'PPN Keluaran',
                'type' => 'liability',
                'subtype' => 'current_liability',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],

            // ========== MODAL (3-XXXX) ==========
            [
                'code' => '3-0000',
                'name' => 'MODAL',
                'type' => 'equity',
                'subtype' => 'capital',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],
            [
                'code' => '3-1000',
                'name' => 'Modal Pemilik',
                'type' => 'equity',
                'subtype' => 'capital',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],
            [
                'code' => '3-2000',
                'name' => 'Prive',
                'type' => 'equity',
                'subtype' => 'capital',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '3-3000',
                'name' => 'Laba Ditahan',
                'type' => 'equity',
                'subtype' => 'retained_earnings',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],

            // ========== PENDAPATAN (4-XXXX) ==========
            [
                'code' => '4-0000',
                'name' => 'PENDAPATAN',
                'type' => 'revenue',
                'subtype' => 'sales_revenue',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],
            [
                'code' => '4-1000',
                'name' => 'Penjualan',
                'type' => 'revenue',
                'subtype' => 'sales_revenue',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],
            [
                'code' => '4-1100',
                'name' => 'Retur Penjualan',
                'type' => 'revenue',
                'subtype' => 'sales_revenue',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '4-1200',
                'name' => 'Potongan Penjualan',
                'type' => 'revenue',
                'subtype' => 'sales_revenue',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '4-2000',
                'name' => 'Pendapatan Lain-lain',
                'type' => 'revenue',
                'subtype' => 'other_revenue',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],

            // ========== HARGA POKOK PENJUALAN (5-XXXX) ==========
            [
                'code' => '5-0000',
                'name' => 'HARGA POKOK PENJUALAN',
                'type' => 'cogs',
                'subtype' => 'purchase',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '5-1000',
                'name' => 'Pembelian',
                'type' => 'cogs',
                'subtype' => 'purchase',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '5-1100',
                'name' => 'Retur Pembelian',
                'type' => 'cogs',
                'subtype' => 'purchase',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],
            [
                'code' => '5-1200',
                'name' => 'Potongan Pembelian',
                'type' => 'cogs',
                'subtype' => 'purchase',
                'normal_balance' => 'credit',
                'parent_id' => null,
            ],
            [
                'code' => '5-1300',
                'name' => 'Biaya Angkut Pembelian',
                'type' => 'cogs',
                'subtype' => 'freight_in',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],

            // ========== BIAYA OPERASIONAL (6-XXXX) ==========
            [
                'code' => '6-0000',
                'name' => 'BIAYA OPERASIONAL',
                'type' => 'expense',
                'subtype' => 'operating_expense',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '6-1000',
                'name' => 'Biaya Gaji',
                'type' => 'expense',
                'subtype' => 'operating_expense',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '6-1100',
                'name' => 'Biaya Listrik',
                'type' => 'expense',
                'subtype' => 'operating_expense',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '6-1200',
                'name' => 'Biaya Sewa',
                'type' => 'expense',
                'subtype' => 'operating_expense',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '6-1300',
                'name' => 'Biaya Transportasi',
                'type' => 'expense',
                'subtype' => 'operating_expense',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '6-1400',
                'name' => 'Biaya Marketing',
                'type' => 'expense',
                'subtype' => 'operating_expense',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '6-1500',
                'name' => 'Biaya Penyusutan',
                'type' => 'expense',
                'subtype' => 'operating_expense',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '6-1600',
                'name' => 'Biaya ATK',
                'type' => 'expense',
                'subtype' => 'operating_expense',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
            [
                'code' => '6-2000',
                'name' => 'Biaya Lain-lain',
                'type' => 'expense',
                'subtype' => 'other_expense',
                'normal_balance' => 'debit',
                'parent_id' => null,
            ],
        ];

        foreach ($accounts as $account) {
            Account::create($account);
        }
    }
}

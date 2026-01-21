<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [

            // ================= ASET =================
            [
                'code' => '1100',
                'name' => 'Kas',
                'type' => 'asset',
                'category' => 'cash',
                'normal_balance' => 'debit',
                'is_cash_account' => true,
            ],
            [
                'code' => '1110',
                'name' => 'Kas Kecil',
                'type' => 'asset',
                'category' => 'cash',
                'normal_balance' => 'debit',
                'is_cash_account' => true,
            ],
            [
                'code' => '1200',
                'name' => 'Bank',
                'type' => 'asset',
                'category' => 'bank',
                'normal_balance' => 'debit',
                'is_bank_account' => true,
            ],
            [
                'code' => '1210',
                'name' => 'Bank BCA',
                'type' => 'asset',
                'category' => 'bank',
                'normal_balance' => 'debit',
                'is_bank_account' => true,
            ],
            [
                'code' => '1220',
                'name' => 'Bank Mandiri',
                'type' => 'asset',
                'category' => 'bank',
                'normal_balance' => 'debit',
                'is_bank_account' => true,
            ],
            [
                'code' => '1300',
                'name' => 'Piutang Usaha',
                'type' => 'asset',
                'category' => 'accounts_receivable',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '1400',
                'name' => 'Persediaan Barang Dagang',
                'type' => 'asset',
                'category' => 'inventory',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '1500',
                'name' => 'PPN Masukan',
                'type' => 'asset',
                'category' => 'tax_input',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '1600',
                'name' => 'Peralatan',
                'type' => 'asset',
                'category' => 'fixed_asset',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '1610',
                'name' => 'Akumulasi Penyusutan Peralatan',
                'type' => 'asset',
                'category' => 'fixed_asset',
                'normal_balance' => 'credit',
                'is_contra' => true,
            ],

            // ================= LIABILITAS =================
            [
                'code' => '2100',
                'name' => 'Utang Usaha',
                'type' => 'liability',
                'category' => 'accounts_payable',
                'normal_balance' => 'credit',
            ],
            [
                'code' => '2200',
                'name' => 'Utang Gaji',
                'type' => 'liability',
                'category' => 'salary_payable',
                'normal_balance' => 'credit',
            ],
            [
                'code' => '2300',
                'name' => 'PPN Keluaran',
                'type' => 'liability',
                'category' => 'tax_output',
                'normal_balance' => 'credit',
            ],

            // ================= EKUITAS =================
            [
                'code' => '3100',
                'name' => 'Modal Pemilik',
                'type' => 'equity',
                'category' => 'capital',
                'normal_balance' => 'credit',
            ],
            [
                'code' => '3200',
                'name' => 'Prive',
                'type' => 'equity',
                'category' => 'drawing',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '3300',
                'name' => 'Laba Ditahan',
                'type' => 'equity',
                'category' => 'retained_earnings',
                'normal_balance' => 'credit',
            ],

            // ================= PENDAPATAN =================
            [
                'code' => '4100',
                'name' => 'Penjualan',
                'type' => 'revenue',
                'category' => 'sales_revenue',
                'normal_balance' => 'credit',
            ],
            [
                'code' => '4110',
                'name' => 'Retur Penjualan',
                'type' => 'revenue',
                'category' => 'sales_return',
                'normal_balance' => 'debit',
                'is_contra' => true,
            ],
            [
                'code' => '4120',
                'name' => 'Potongan Penjualan',
                'type' => 'revenue',
                'category' => 'sales_discount',
                'normal_balance' => 'debit',
                'is_contra' => true,
            ],

            // ================= HPP (EXPENSE) =================
            [
                'code' => '5100',
                'name' => 'Harga Pokok Penjualan',
                'type' => 'expense',
                'category' => 'cogs',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '5110',
                'name' => 'Pembelian',
                'type' => 'expense',
                'category' => 'purchase',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '5120',
                'name' => 'Retur Pembelian',
                'type' => 'expense',
                'category' => 'purchase_return',
                'normal_balance' => 'credit',
                'is_contra' => true,
            ],
            [
                'code' => '5130',
                'name' => 'Biaya Angkut Pembelian',
                'type' => 'expense',
                'category' => 'freight_in',
                'normal_balance' => 'debit',
            ],

            // ================= BEBAN OPERASIONAL =================
            [
                'code' => '6100',
                'name' => 'Beban Gaji',
                'type' => 'expense',
                'category' => 'operating_expense',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '6110',
                'name' => 'Beban Listrik & Air',
                'type' => 'expense',
                'category' => 'operating_expense',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '6120',
                'name' => 'Beban Sewa',
                'type' => 'expense',
                'category' => 'operating_expense',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '6130',
                'name' => 'Beban Transportasi',
                'type' => 'expense',
                'category' => 'operating_expense',
                'normal_balance' => 'debit',
            ],
            [
                'code' => '6200',
                'name' => 'Beban Lain-lain',
                'type' => 'expense',
                'category' => 'other_expense',
                'normal_balance' => 'debit',
            ],
        ];

        foreach ($accounts as $account) {
            Account::create($account);
        }
    }
}

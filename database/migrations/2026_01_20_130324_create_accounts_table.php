<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            // Kode akun (misal: 1101, 4101, 5101)
            $table->string('code')->unique();

            // Nama akun
            $table->string('name');

            /**
             * Tipe utama akun (PSAK)
             * asset | liability | equity | revenue | expense
             */
            $table->string('type');

            /**
             * Kategori / sub tipe (fleksibel)
             * contoh:
             * cash, bank, accounts_receivable, inventory,
             * accounts_payable, tax_payable,
             * sales_revenue, sales_return,
             * cogs, operating_expense
             */
            $table->string('category')->nullable();

            // Hirarki akun
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('accounts')
                ->nullOnDelete();

            // Saldo awal
            $table->decimal('opening_balance', 15, 2)->default(0);

            /**
             * Saldo normal
             * debit | credit
             */
            $table->enum('normal_balance', ['debit', 'credit']);

            // Akun kontra (akumulasi penyusutan, retur penjualan, dll)
            $table->boolean('is_contra')->default(false);

            // Penanda akun kas & bank
            $table->boolean('is_cash_account')->default(false);
            $table->boolean('is_bank_account')->default(false);

            // Status
            $table->boolean('is_active')->default(true);

            // Keterangan
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};

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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();

            // Simpan snapshot data customer saat transaksi (untuk histori)
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->text('customer_address')->nullable();

            // Informasi Faktur
            $table->date('transaction_date')->default(now());
            $table->date('due_date')->nullable(); // Untuk kredit

            // Perhitungan
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0); // Diskon
            $table->decimal('tax', 12, 2)->default(0); // PPN/Pajak
            $table->decimal('total_amount', 12, 2)->default(0);

            // Status
            $table->enum('status', ['draft', 'pending', 'processing', 'completed', 'cancelled'])
                ->default('draft');
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->enum('payment_method', ['cash', 'transfer', 'card', 'ewallet', 'credit'])
                ->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

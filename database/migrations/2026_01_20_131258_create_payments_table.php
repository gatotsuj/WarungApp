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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['receivable', 'payable']);
            $table->date('payment_date');

            $table->string('payable_type');
            $table->unsignedBigInteger('payable_id');

            $table->foreignId('account_id')->constrained();
            $table->decimal('amount', 15, 2);
            $table->enum('method', ['cash', 'transfer', 'card', 'ewallet', 'giro', 'check']);
            $table->string('reference_number')->nullable();

            $table->foreignId('journal_entry_id')->nullable()->constrained()->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['payable_type', 'payable_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

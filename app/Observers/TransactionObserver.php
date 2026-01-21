<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        Log::info("Observer fired: Transaction created ID {$transaction->id}");

        $code = 'JRN-'.date('Ymd').'-'.str_pad(
            JournalEntry::whereDate('created_at', today())->count() + 1,
            4,
            '0',
            STR_PAD_LEFT
        );

        Log::info("Generated journal code: {$code}");

        $cashAccount = Account::where('code', '1100')->first();
        $salesAccount = Account::where('code', '4100')->first();

        if (! $cashAccount) {
            Log::error('Cash account not found (code 1-1001)');

            return;
        }
        if (! $salesAccount) {
            Log::error('Sales account not found (code 4-1000)');

            return;
        }

        Log::info("Found accounts: cash_id={$cashAccount->id}, sales_id={$salesAccount->id}");

        try {
            $journalEntry = JournalEntry::create([
                'code' => $code,
                'entry_date' => $transaction->created_at->toDateString(),
                'type' => 'sales',
                'description' => 'Jurnal untuk transaksi '.$transaction->code,
                'total_debit' => $transaction->total_amount,
                'total_credit' => $transaction->total_amount,
                'status' => 'posted',
                'posted_at' => now(),
                'posted_by' => Auth::id() ?? null,
            ]);

            Log::info("Journal entry created with ID {$journalEntry->id}");
            Log::info('Transaction total_amount: ', ['total_amount' => $transaction->total_amount]);

            $journalEntry->journal_entry_lines()->createMany([
                [
                    'account_id' => $cashAccount->id,
                    'debit' => $transaction->total_amount,
                    'credit' => 0,
                    'description' => 'Kas masuk dari transaksi '.$transaction->code,
                ],
                [
                    'account_id' => $salesAccount->id,
                    'debit' => 0,
                    'credit' => $transaction->total_amount,
                    'description' => 'Pendapatan penjualan dari transaksi '.$transaction->code,
                ],
            ]);

            Log::info('Journal entry lines created successfully');
        } catch (\Exception $e) {
            Log::error('Error creating journal entry: '.$e->getMessage());
        }
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
        Log::info("Observer fired: Transaction updated ID {$transaction->id}");

        // Pastikan hanya buat jurnal kalau status sudah selesai dan total_amount valid
        if ($transaction->status !== 'completed') {
            Log::info('Transaction belum selesai, skip jurnal');

            return;
        }

        if ($transaction->total_amount <= 0) {
            Log::info('Total amount <= 0, skip jurnal');

            return;
        }

        // Cek apakah jurnal sudah ada agar tidak dobel
        if ($transaction->journalEntry()->exists()) {
            Log::info('Journal entry sudah ada, skip pembuatan ulang');

            return;
        }

        // Buat kode jurnal otomatis
        $code = 'JRN-'.date('Ymd').'-'.str_pad(
            JournalEntry::whereDate('created_at', today())->count() + 1,
            4,
            '0',
            STR_PAD_LEFT
        );

        $cashAccount = Account::where('code', '1100')->first();
        $salesAccount = Account::where('code', '4100')->first();

        if (! $cashAccount || ! $salesAccount) {
            Log::error('Cash or Sales account not found');

            return;
        }

        try {
            $journalEntry = JournalEntry::create([
                'code' => $code,
                'entry_date' => $transaction->updated_at->toDateString(),
                'type' => 'sales',
                'description' => 'Jurnal untuk transaksi '.$transaction->code,
                'total_debit' => $transaction->total_amount,
                'total_credit' => $transaction->total_amount,
                'status' => 'posted',
                'posted_at' => now(),
                'posted_by' => Auth::id() ?? null,
            ]);

            $journalEntry->journal_entry_lines()->createMany([
                [
                    'account_id' => $cashAccount->id,
                    'debit' => $transaction->total_amount,
                    'credit' => 0,
                    'description' => 'Kas masuk dari transaksi '.$transaction->code,
                ],
                [
                    'account_id' => $salesAccount->id,
                    'debit' => 0,
                    'credit' => $transaction->total_amount,
                    'description' => 'Pendapatan penjualan dari transaksi '.$transaction->code,
                ],
            ]);

            Log::info("Journal entry and lines created successfully for transaction ID {$transaction->id}");
        } catch (\Exception $e) {
            Log::error('Error creating journal entry: '.$e->getMessage());
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    //
    public function invoice(Transaction $transaction)
    {
        $transaction->load(['items.product']);

        return view('transactions.invoice', compact('transaction'));
    }
}

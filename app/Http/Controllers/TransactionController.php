<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    public function invoice(Transaction $transaction)
    {
        $transaction->load(['items.product']);
        $user = Auth::user();

        return view('transactions.invoice', compact('transaction', 'user'));
    }
}

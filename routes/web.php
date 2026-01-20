<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/transactions/{transaction}/invoice', [TransactionController::class, 'invoice'])
    ->name('transactions.invoice');

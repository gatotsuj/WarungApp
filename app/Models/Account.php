<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'code', 'name', 'type', 'category', 'parent_id',
        'opening_balance', 'normal_balance', 'is_active',
        'is_cash_account', 'is_bank_account', 'is_contra', 'description',
    ];

    protected $casts = [
        'opening_balance' => 'decimal:2',
        'is_active' => 'boolean',
        'is_cash_account' => 'boolean',
        'is_bank_account' => 'boolean',
        'is_contra' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

    // Contoh relasi jurnal (aktifkan jika model ada)
    /*
    public function journalEntryLines()
    {
        return $this->hasMany(JournalEntryLine::class);
    }
    */

    /**
     * Hitung saldo saat ini
     * dengan memperhitungkan saldo awal dan transaksi jurnal yang sudah diposting
     */
    public function getCurrentBalance(): float
    {
        $total = $this->journalEntryLines()
            ->whereHas('journalEntry', fn ($q) => $q->where('status', 'posted'))
            ->selectRaw('SUM(debit) as total_debit, SUM(credit) as total_credit')
            ->first();

        $balance = $this->opening_balance ?? 0;

        if ($this->normal_balance === 'debit') {
            $balance += ($total->total_debit ?? 0) - ($total->total_credit ?? 0);
        } else {
            $balance += ($total->total_credit ?? 0) - ($total->total_debit ?? 0);
        }

        // Jika akun kontra, invert saldo
        if ($this->is_contra) {
            $balance = -$balance;
        }

        return $balance;
    }
}

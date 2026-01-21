<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'code', 'customer_id', 'customer_name', 'customer_phone',
        'customer_email', 'customer_address', 'transaction_date', 'due_date',
        'subtotal', 'discount', 'tax', 'total_amount',
        'status', 'payment_status', 'payment_method',
        'journal_entry_id', 'notes',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    /*
        public function journalEntry()
        {
            return $this->belongsTo(JournalEntry::class);
        }

        public function payments()
        {
            return $this->morphMany(Payment::class, 'payable');
        }

        public function stockMovements()
        {
            return $this->morphMany(StockMovement::class, 'reference');
        }
    */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (! $transaction->code) {
                $year = date('Y');
                $count = Transaction::whereYear('created_at', $year)->count() + 1;
                $transaction->code = 'INV-'.$year.'-'.str_pad($count, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    protected static function booted()
    {
        static::saved(function ($transaction) {
            $transaction->updateQuietly([
                'total_amount' => $transaction->items()->sum('subtotal'),
            ]);
        });
    }

    public function journalEntry()
    {
        return $this->hasOne(JournalEntry::class, 'reference_id')
            ->where('reference_type', self::class);
    }
}

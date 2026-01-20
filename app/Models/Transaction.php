<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'code',
        'customer_name',
        'customer_phone',
        'total_amount',
        'status',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    protected static function booted()
    {
        static::saved(function ($transaction) {
            $transaction->updateQuietly([
                'total_amount' => $transaction->items()->sum('subtotal'),
            ]);
        });
    }
}

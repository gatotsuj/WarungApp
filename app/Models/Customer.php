<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'email', 'phone', 'address',
        'city', 'province', 'postal_code', 'type', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (! $customer->code) {
                $customer->code = 'CUST-'.str_pad(Customer::max('id') + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
        'code', 'name', 'contact_person', 'email', 'phone',
        'address', 'city', 'tax_number', 'payment_term', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($supplier) {
            if (! $supplier->code) {
                $supplier->code = 'SUP-'.str_pad(Supplier::max('id') + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}

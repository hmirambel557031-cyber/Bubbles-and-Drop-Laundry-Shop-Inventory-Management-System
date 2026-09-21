<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'customer_code',
        'full_name',
        'contact_number',
    ];

    public function laundryOrders(): HasMany
    {
        return $this->hasMany(LaundryOrder::class);
    }
}
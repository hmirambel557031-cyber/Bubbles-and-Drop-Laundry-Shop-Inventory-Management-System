<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'service_name',
        'price',
        'description',
    ];

    public function laundryOrders(): HasMany
    {
        return $this->hasMany(LaundryOrder::class);
    }
}
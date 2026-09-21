<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaundryOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'service_id',
        'service_number',
        'kilos',
        'load_count',
        'detergent_quantity',
        'fabric_conditioner_quantity',
        'total_amount',
        'status',
        'received_at',
        'completed_at',
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
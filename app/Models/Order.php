<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    /**
     * Get all of the comments for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}

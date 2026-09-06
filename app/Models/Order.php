<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_number', 'subtotal', 'shipping_cost', 'total_amount', 'payment_method', 'payment_token', 'midtrans_transaction_id', 'payment_status', 'order_status', 'recipient_name', 'phone', 'shipping_address', 'city', 'province', 'postal_code', 'paid_at', 'expired_at'];

    protected function casts(): array
    {
        return ['subtotal' => 'decimal:2', 'shipping_cost' => 'decimal:2', 'total_amount' => 'decimal:2', 'paid_at' => 'datetime', 'expired_at' => 'datetime'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

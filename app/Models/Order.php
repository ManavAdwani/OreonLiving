<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'subtotal',
        'discount',
        'coupon_code',
        'shipping_fee',
        'tax',
        'total',
        'payment_method',
        'payment_status',
        'order_status',
        'tracking_number',
        'carrier_name',
        'tracking_url',
        'notes',
        'cancellation_reason',
        'return_reason',
        'utm_source',
        'utm_medium',
        'utm_campaign',
    ];

    protected function casts(): array
    {
        return [
            'shipping_address' => 'array',
            'subtotal' => 'decimal:2',
            'discount' => 'decimal:2',
            'shipping_fee' => 'decimal:2',
            'tax' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->order_status) {
            'pending' => 'badge-warning',
            'confirmed' => 'badge-info',
            'processing' => 'badge-primary',
            'shipped' => 'badge-secondary',
            'delivered' => 'badge-success',
            'cancelled' => 'badge-danger',
            'return_requested' => 'badge-warning',
            'refunded' => 'badge-dark',
            default => 'badge-neutral',
        };
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->order_status, ['pending', 'confirmed', 'processing']);
    }

    public function canBeReturned(): bool
    {
        return $this->order_status === 'delivered' 
            && $this->updated_at->addDays(7)->isFuture();
    }
}

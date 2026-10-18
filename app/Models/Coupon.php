<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'minimum_order',
        'max_discount',
        'max_uses',
        'used_count',
        'starts_at',
        'expires_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'minimum_order' => 'decimal:2',
            'max_discount' => 'decimal:2',
            'max_uses' => 'integer',
            'used_count' => 'integer',
            'starts_at' => 'datetime',
            'expires_at' => 'datetime',
            'status' => 'boolean',
        ];
    }

    public function isValidFor(float $subtotal): array
    {
        if (!$this->status) {
            return ['valid' => false, 'message' => 'This coupon is inactive.'];
        }

        if ($this->starts_at && now()->lt($this->starts_at)) {
            return ['valid' => false, 'message' => 'This coupon offer has not started yet.'];
        }

        if ($this->expires_at && now()->gt($this->expires_at)) {
            return ['valid' => false, 'message' => 'This coupon code has expired.'];
        }

        if ($this->max_uses && $this->used_count >= $this->max_uses) {
            return ['valid' => false, 'message' => 'This coupon code usage limit has been reached.'];
        }

        if ($this->minimum_order && $subtotal < $this->minimum_order) {
            return ['valid' => false, 'message' => 'Minimum order amount for this coupon is ₹' . number_format($this->minimum_order, 2) . '.'];
        }

        return ['valid' => true, 'message' => 'Coupon applied successfully!'];
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === 'percentage') {
            $discount = ($subtotal * $this->value) / 100;
            if ($this->max_discount && $discount > $this->max_discount) {
                $discount = $this->max_discount;
            }
            return round($discount, 2);
        }

        return round(min($this->value, $subtotal), 2);
    }
}

<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'is_active',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Role checks
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isContentManager(): bool
    {
        return $this->role === 'content_manager';
    }

    public function isProductManager(): bool
    {
        return $this->role === 'product_manager';
    }

    public function isOrderManager(): bool
    {
        return $this->role === 'order_manager';
    }

    public function isCustomerSupport(): bool
    {
        return $this->role === 'customer_support';
    }

    public function isMarketingManager(): bool
    {
        return $this->role === 'marketing_manager';
    }

    public function isViewer(): bool
    {
        return $this->role === 'viewer';
    }

    public function isStaff(): bool
    {
        return in_array($this->role, [
            'super_admin',
            'content_manager',
            'product_manager',
            'order_manager',
            'customer_support',
            'marketing_manager',
            'viewer',
        ]);
    }

    /**
     * Check if user can access a specific admin section based on PDF permissions table
     */
    public function canAccessSection(string $section): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return match ($section) {
            'products' => in_array($this->role, ['product_manager', 'viewer']),
            'categories' => in_array($this->role, ['product_manager', 'content_manager', 'viewer']),
            'orders' => in_array($this->role, ['order_manager', 'customer_support', 'viewer']),
            'customers' => in_array($this->role, ['customer_support', 'order_manager', 'viewer']),
            'reviews' => in_array($this->role, ['content_manager', 'customer_support', 'viewer']),
            'coupons' => in_array($this->role, ['marketing_manager', 'viewer']),
            'content', 'banners', 'faqs' => in_array($this->role, ['content_manager', 'viewer']),
            'marketing' => in_array($this->role, ['marketing_manager', 'viewer']),
            'support', 'contacts' => in_array($this->role, ['customer_support', 'viewer']),
            'reports' => in_array($this->role, ['marketing_manager', 'order_manager', 'viewer']),
            'settings' => in_array($this->role, ['super_admin', 'content_manager']),
            'activity_logs', 'staff' => $this->isSuperAdmin(),
            default => false,
        };
    }
}

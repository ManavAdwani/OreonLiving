<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'short_description',
        'description',
        'price',
        'compare_price',
        'cost_price',
        'stock',
        'low_stock_threshold',
        'weight_grams',
        'dimensions',
        'material',
        'care_instructions',
        'video_url',
        'status',
        'featured',
        'bestseller',
        'seo_title',
        'seo_description',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'compare_price' => 'decimal:2',
            'cost_price' => 'decimal:2',
            'stock' => 'integer',
            'low_stock_threshold' => 'integer',
            'weight_grams' => 'integer',
            'featured' => 'boolean',
            'bestseller' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('status', 'approved')->latest();
    }

    public function primaryImage()
    {
        return $this->images()->where('is_primary', true)->first() 
            ?? $this->images()->first();
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        $primary = $this->primaryImage();
        if ($primary && $primary->image_path) {
            return str_starts_with($primary->image_path, 'http') 
                ? $primary->image_path 
                : asset('storage/' . $primary->image_path);
        }
        return asset('images/placeholder-pottery.jpg');
    }

    public function getSecondaryImageUrlAttribute(): ?string
    {
        $second = $this->images()->skip(1)->first();
        if ($second && $second->image_path) {
            return str_starts_with($second->image_path, 'http') 
                ? $second->image_path 
                : asset('storage/' . $second->image_path);
        }
        return null;
    }

    public function getDiscountPercentAttribute(): ?int
    {
        if ($this->compare_price && $this->compare_price > $this->price) {
            return (int) round((($this->compare_price - $this->price) / $this->compare_price) * 100);
        }
        return null;
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->approvedReviews()->avg('rating') ?? 5.0, 1);
    }

    public function getReviewsCountAttribute(): int
    {
        return $this->approvedReviews()->count();
    }

    public function isLowStock(): bool
    {
        return $this->stock > 0 && $this->stock <= $this->low_stock_threshold;
    }

    public function isOutOfStock(): bool
    {
        return $this->stock <= 0;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->published()->where('featured', true);
    }

    public function scopeBestsellers($query)
    {
        return $query->published()->where('bestseller', true);
    }
}

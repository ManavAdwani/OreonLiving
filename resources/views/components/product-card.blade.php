@props(['product'])

@php
    $primaryImg = $product->primary_image_url;
    $secondaryImg = $product->secondary_image_url ?? $primaryImg;
    $isWishlisted = auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists();
@endphp

<article class="product-card" id="product-{{ $product->id }}">
    <div class="product-card-image">
        <a href="{{ route('product.show', $product->slug) }}">
            <img src="{{ $primaryImg }}" alt="{{ $product->name }}" class="primary-img" loading="lazy">
            @if($secondaryImg !== $primaryImg)
                <img src="{{ $secondaryImg }}" alt="{{ $product->name }} Lifestyle" class="secondary-img" loading="lazy">
            @endif
        </a>

        <!-- Badges -->
        <div class="product-card-badge">
            @if($product->bestseller)
                <span class="badge badge-dark">Bestseller</span>
            @elseif($product->isLowStock())
                <span class="badge badge-warning">Only {{ $product->stock }} left</span>
            @elseif($product->isOutOfStock())
                <span class="badge badge-danger">Sold Out</span>
            @elseif($product->featured)
                <span class="badge badge-clay">Featured</span>
            @endif
        </div>

        <!-- Wishlist Button -->
        <button type="button" 
                class="product-wishlist-btn {{ $isWishlisted ? 'active' : '' }}" 
                onclick="toggleWishlist({{ $product->id }}, this)" 
                title="{{ $isWishlisted ? 'Remove from wishlist' : 'Save to wishlist' }}"
                aria-label="Wishlist">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="{{ $isWishlisted ? 'var(--color-clay)' : 'none' }}" stroke="{{ $isWishlisted ? 'var(--color-clay)' : 'currentColor' }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </button>
    </div>

    <div class="product-card-info">
        @if($product->category)
            <span class="product-card-category">{{ $product->category->name }}</span>
        @endif

        <h3 class="product-card-title">
            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
        </h3>

        @if($product->short_description)
            <p class="product-card-desc">{{ $product->short_description }}</p>
        @endif

        <div class="product-card-price">
            <span class="current-price">₹{{ number_format($product->price, 2) }}</span>
            @if($product->compare_price && $product->compare_price > $product->price)
                <span class="compare-price">₹{{ number_format($product->compare_price, 2) }}</span>
                <span class="discount-tag">{{ $product->discount_percent }}% OFF</span>
            @endif
        </div>

        @if(!$product->isOutOfStock())
            <button type="button" class="quick-add-btn" onclick="quickAddToCart({{ $product->id }})">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-2z"></path><line x1="3" y1="6" x2="21" y2="6"></line></svg>
                <span>Add to Cart</span>
            </button>
        @else
            <button type="button" class="quick-add-btn" disabled style="opacity: 0.6; cursor: not-allowed;">
                <span>Out of Stock</span>
            </button>
        @endif
    </div>
</article>

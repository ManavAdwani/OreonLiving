@extends('layouts.app')

@section('title', ($product->seo_title ?: $product->name) . ' | Oreon Living')
@section('meta_description', $product->seo_description ?: $product->short_description)

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('shop.index') }}">Shop</a>
        <span class="breadcrumb-separator">/</span>
        @if($product->category)
            <a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a>
            <span class="breadcrumb-separator">/</span>
        @endif
        <span>{{ $product->name }}</span>
    </nav>

    <!-- Product Main Grid: Gallery + Details -->
    <div class="pdp-layout">
        <!-- 1. Image Gallery -->
        <div class="pdp-gallery">
            <div style="aspect-ratio: 4/5; background-color: var(--color-surface-subtle); border-radius: var(--radius-sm); overflow: hidden; margin-bottom: 1rem; border: 1px solid var(--color-border);">
                <img id="mainProductImg" src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <!-- Thumbnails -->
            @if($product->images->count() > 1)
                <div class="flex gap-2" style="overflow-x: auto; padding-bottom: 0.5rem;">
                    @foreach($product->images as $img)
                        <button type="button" 
                                onclick="document.getElementById('mainProductImg').src = '{{ $img->url }}'"
                                style="width: 76px; height: 95px; border-radius: var(--radius-sm); overflow: hidden; border: 1px solid var(--color-border); flex-shrink: 0; cursor: pointer;">
                            <img src="{{ $img->url }}" alt="{{ $img->alt_text }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </button>
                    @endforeach
                </div>
            @endif

            <!-- Product Video Section (PDF item 10) -->
            @if($product->video_url)
                <div style="margin-top: 2rem;">
                    <h4 style="font-size: 0.9375rem; font-family: var(--font-body); font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 0.75rem; color: var(--color-text-muted);">
                        Artisan Craft Video
                    </h4>
                    <div style="aspect-ratio: 16/9; background: #000; border-radius: var(--radius-sm); overflow: hidden;">
                        <iframe width="100%" height="100%" src="{{ $product->video_url }}" title="{{ $product->name }} Crafting" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            @endif
        </div>

        <!-- 2. Product Information & Actions -->
        <div class="pdp-info">
            @if($product->category)
                <span class="text-uppercase text-xs text-clay" style="margin-bottom: 0.5rem; display: block;">{{ $product->category->name }}</span>
            @endif

            <h1 style="font-size: clamp(2rem, 3.5vw, 2.75rem); line-height: 1.2; margin-bottom: 0.75rem;">{{ $product->name }}</h1>

            <!-- Ratings & SKU -->
            <div class="flex items-center gap-3" style="margin-bottom: 1.5rem; flex-wrap: wrap;">
                <div class="flex items-center gap-1" style="color: #D97706; font-size: 0.875rem;">
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="{{ $i <= $product->average_rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        @endfor
                    </div>
                    <span style="font-weight: 600; color: var(--color-text); margin-left: 0.25rem;">{{ $product->average_rating }}</span>
                    <span style="color: var(--color-text-muted);">({{ $product->reviews_count }} verified reviews)</span>
                </div>
                <span style="color: var(--color-border-dark);">|</span>
                <span style="font-size: 0.8125rem; color: var(--color-text-muted);">SKU: <strong id="productSkuDisplay">{{ $product->sku }}</strong></span>
            </div>

            <!-- Price Block -->
            <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 1.25rem 1.5rem; border-radius: var(--radius-sm); margin-bottom: 1.75rem;">
                <div class="flex items-baseline gap-2">
                    <span id="priceDisplay" style="font-size: 1.85rem; font-weight: 700; color: var(--color-text);">₹{{ number_format($product->price, 2) }}</span>
                    @if($product->compare_price && $product->compare_price > $product->price)
                        <span id="comparePriceDisplay" style="font-size: 1.125rem; color: var(--color-text-light); text-decoration: line-through;">₹{{ number_format($product->compare_price, 2) }}</span>
                        <span class="badge badge-clay">{{ $product->discount_percent }}% OFF</span>
                    @endif
                </div>
                <p style="font-size: 0.75rem; color: var(--color-text-muted); margin-top: 0.35rem;">Inclusive of all taxes &bull; 100% Breakage-Free Transit Guarantee</p>
            </div>

            <!-- Stock Availability (PDF item 17, 120, 121, 122) -->
            <div style="margin-bottom: 1.5rem;">
                @if($product->isOutOfStock())
                    <span class="badge badge-danger" style="font-size: 0.8125rem; padding: 0.4rem 0.85rem;">Currently Sold Out</span>
                    <p style="font-size: 0.8125rem; color: var(--color-text-muted); margin-top: 0.5rem;">Our artisans are currently throwing new batches. Enquire on WhatsApp for next kiln release.</p>
                @elseif($product->isLowStock())
                    <span class="badge badge-warning" style="font-size: 0.8125rem; padding: 0.4rem 0.85rem;">Low Stock: Only {{ $product->stock }} pieces remaining in workshop</span>
                @else
                    <span class="badge badge-success" style="font-size: 0.8125rem; padding: 0.4rem 0.85rem;">In Stock &bull; Ready to Dispatch in 24 Hours</span>
                @endif
            </div>

            <!-- Short Description -->
            @if($product->short_description)
                <p class="lead-text" style="margin-bottom: 1.75rem; font-size: 1rem;">{{ $product->short_description }}</p>
            @endif

            <!-- Add to Cart & Buy Now Form -->
            <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm" style="margin-bottom: 2rem;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variant_id" id="selectedVariantId" value="">

                <!-- Product Variants (PDF item 8) -->
                @if($product->variants->isNotEmpty())
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted); margin-bottom: 0.5rem;">
                            Select Size / Option:
                        </label>
                        <div class="flex gap-2" style="flex-wrap: wrap;">
                            <label style="padding: 0.6rem 1.25rem; border: 1.5px solid var(--color-clay); border-radius: var(--radius-sm); font-size: 0.875rem; cursor: pointer; background: var(--color-clay-light); font-weight: 500;">
                                <input type="radio" name="variant_choice" value="" checked onchange="updateVariant(null, '{{ $product->sku }}', {{ $product->price }})" style="display:none;">
                                Standard Piece
                            </label>
                            @foreach($product->variants as $variant)
                                <label style="padding: 0.6rem 1.25rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm); font-size: 0.875rem; cursor: pointer; background: var(--color-surface); font-weight: 500;" class="variant-option">
                                    <input type="radio" name="variant_choice" value="{{ $variant->id }}" onchange="updateVariant({{ $variant->id }}, '{{ $variant->sku ?: $product->sku }}', {{ $variant->price ?: $product->price }})" style="display:none;">
                                    {{ $variant->title }} @if($variant->price)(₹{{ number_format($variant->price, 2) }})@endif
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Quantity Selector (PDF item 19) -->
                <div class="flex items-center gap-3" style="margin-bottom: 1.5rem;">
                    <label style="font-size: 0.875rem; font-weight: 600; color: var(--color-text);">Quantity:</label>
                    <div style="display: inline-flex; align-items: center; border: 1px solid var(--color-border); border-radius: var(--radius-sm); background: var(--color-surface);">
                        <button type="button" onclick="decrementQty()" style="padding: 0.5rem 0.9rem; font-size: 1.1rem; color: var(--color-text);">&minus;</button>
                        <input type="number" name="quantity" id="quantityInput" value="1" min="1" max="{{ $product->stock }}" style="width: 48px; text-align: center; font-weight: 600; border: none; font-size: 0.9375rem;" readonly>
                        <button type="button" onclick="incrementQty()" style="padding: 0.5rem 0.9rem; font-size: 1.1rem; color: var(--color-text);">&plus;</button>
                    </div>
                </div>

                <!-- CTA Actions: Add to Cart + Buy Now + Wishlist (PDF item 19, 20, 21) -->
                <div class="flex gap-2" style="flex-wrap: wrap;">
                    @if(!$product->isOutOfStock())
                        <button type="submit" class="btn btn-primary btn-lg" style="flex: 1; min-width: 180px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-2z"></path><line x1="3" y1="6" x2="21" y2="6"></line></svg>
                            <span>Add to Cart</span>
                        </button>
                        <button type="submit" name="buy_now" value="1" class="btn btn-dark btn-lg" style="flex: 1; min-width: 180px;">
                            Buy Now
                        </button>
                    @else
                        <button type="button" class="btn btn-secondary btn-lg btn-block" disabled style="opacity: 0.6; cursor: not-allowed;">
                            Currently Out of Stock
                        </button>
                    @endif

                    <button type="button" 
                            class="btn btn-secondary" 
                            style="padding: 0 1.25rem;" 
                            onclick="toggleWishlist({{ $product->id }}, this)" 
                            title="Save to Wishlist">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </button>
                </div>
            </form>

            <!-- Product-Specific WhatsApp Enquiry Button (PDF item 26, 149) -->
            @php
                $waProductMsg = "Hello Oreon Living, I am inquiring about the {$product->name} (SKU: {$product->sku}). Is this currently available for shipping?";
                $whatsappProductUrl = "https://wa.me/" . \App\Models\WebsiteSetting::get('whatsapp_number', '919876543210') . "?text=" . urlencode($waProductMsg);
            @endphp
            <div style="margin-bottom: 2rem;">
                <a href="{{ $whatsappProductUrl }}" target="_blank" rel="noopener noreferrer" 
                   style="display: flex; align-items: center; justify-content: center; gap: 0.6rem; padding: 0.85rem; border: 1.5px solid #25D366; color: #1E7E34; border-radius: var(--radius-sm); font-size: 0.9375rem; font-weight: 600; background-color: #F0FFF4;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#25D366"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2z"></path></svg>
                    <span>Enquire About This Piece on WhatsApp</span>
                </a>
            </div>

            <!-- Pin Code Serviceability Check (PDF item 140, 142) -->
            <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 1.25rem 1.5rem; border-radius: var(--radius-sm); margin-bottom: 2rem;">
                <label for="pincodeInput" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--color-text); margin-bottom: 0.5rem;">
                    Check Delivery & Cash on Delivery (Pin Code)
                </label>
                <div class="flex gap-1">
                    <input type="text" id="pincodeInput" placeholder="Enter 6-digit postal code (e.g. 560001)" maxlength="6" class="form-control" style="font-size: 0.875rem;">
                    <button type="button" onclick="checkPincode()" class="btn btn-dark btn-sm">Check</button>
                </div>
                <div id="pincodeResult" style="margin-top: 0.75rem; font-size: 0.8125rem; display: none;"></div>
            </div>

            <!-- Specifications & Care Tabs/Accordion (PDF item 12, 13, 14, 15, 16) -->
            <div style="border-top: 1px solid var(--color-border); padding-top: 1.5rem;">
                <details open style="margin-bottom: 1.25rem; border-bottom: 1px solid var(--color-border-subtle); padding-bottom: 1rem;">
                    <summary style="font-family: var(--font-display); font-size: 1.25rem; font-weight: 600; cursor: pointer; color: var(--color-text);">
                        Product Narrative & Description
                    </summary>
                    <div style="margin-top: 0.75rem; color: var(--color-text-muted); line-height: 1.8; font-size: 0.9375rem; white-space: pre-line;">
                        {{ $product->description ?: $product->short_description }}
                    </div>
                </details>

                <details style="margin-bottom: 1.25rem; border-bottom: 1px solid var(--color-border-subtle); padding-bottom: 1rem;">
                    <summary style="font-family: var(--font-display); font-size: 1.25rem; font-weight: 600; cursor: pointer; color: var(--color-text);">
                        Materials & Dimensions
                    </summary>
                    <div style="margin-top: 0.75rem; font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.7;">
                        <p style="margin-bottom: 0.4rem;"><strong>Material:</strong> {{ $product->material ?: 'Pure unglazed alluvial clay' }}</p>
                        @if($product->dimensions)
                            <p style="margin-bottom: 0.4rem;"><strong>Dimensions:</strong> {{ $product->dimensions }}</p>
                        @endif
                        @if($product->weight_grams)
                            <p style="margin-bottom: 0.4rem;"><strong>Weight:</strong> {{ number_format($product->weight_grams / 1000, 2) }} kg (approx.)</p>
                        @endif
                        <p><strong>Firing:</strong> Open wood-fired kiln at ~900&deg;C</p>
                    </div>
                </details>

                <details style="margin-bottom: 1.25rem; border-bottom: 1px solid var(--color-border-subtle); padding-bottom: 1rem;">
                    <summary style="font-family: var(--font-display); font-size: 1.25rem; font-weight: 600; cursor: pointer; color: var(--color-text);">
                        Care & Seasoning Instructions
                    </summary>
                    <div style="margin-top: 0.75rem; font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.8;">
                        <p>{{ $product->care_instructions ?: 'Rinse thoroughly with warm water and soft coir brush before first use. Never clean porous clay with chemical dish detergents. Allow to completely air dry in open air.' }}</p>
                    </div>
                </details>

                <details style="margin-bottom: 1.25rem; border-bottom: 1px solid var(--color-border-subtle); padding-bottom: 1rem;">
                    <summary style="font-family: var(--font-display); font-size: 1.25rem; font-weight: 600; cursor: pointer; color: var(--color-text);">
                        Packaging & Breakage Guarantee
                    </summary>
                    <div style="margin-top: 0.75rem; font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.8;">
                        <p>Each earthen piece is individually wrapped in biodegradable corrugated honeycomb wrap and placed in reinforced double-walled export boxes. We guarantee zero breakage during transit; if damaged, share an unboxing photo within 48 hours for an instant complimentary replacement.</p>
                    </div>
                </details>
            </div>
        </div>
    </div>

    <!-- Customer Reviews Section (PDF item 27) -->
    <section style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(2rem, 4vw, 3.5rem); margin-bottom: 5rem;">
        <div class="flex justify-between items-center" style="margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="text-uppercase text-xs text-clay">Customer Community</span>
                <h2 style="margin-top: 0.25rem;">Verified Patron Reviews</h2>
            </div>
            <a href="#reviewForm" class="btn btn-secondary btn-sm">Write a Review</a>
        </div>

        @if($product->approvedReviews->isEmpty())
            <p class="text-muted" style="font-style: italic; margin-bottom: 2rem;">Be the first to share your thoughts on this handcrafted earthen creation.</p>
        @else
            <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.75rem; margin-bottom: 3rem;">
                @foreach($product->approvedReviews as $review)
                    <div style="border: 1px solid var(--color-border-subtle); padding: 1.5rem; border-radius: var(--radius-sm); background-color: var(--color-surface-subtle);">
                        <div class="flex gap-1" style="color: #D97706; margin-bottom: 0.5rem;">
                            @for($i = 0; $i < $review->rating; $i++)
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            @endfor
                        </div>
                        @if($review->title)
                            <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 0.35rem;">{{ $review->title }}</h4>
                        @endif
                        <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0.75rem;">{{ $review->body }}</p>
                        <span style="font-size: 0.75rem; font-weight: 600; color: var(--color-text);">{{ $review->customer_name }} &bull; <span style="font-weight: 400; color: var(--color-text-light);">{{ $review->created_at->format('M d, Y') }}</span></span>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Review Submission Form -->
        <div id="reviewForm" style="border-top: 1px solid var(--color-border); padding-top: 2rem; max-width: 600px;">
            <h3 style="font-size: 1.35rem; margin-bottom: 1rem;">Share Your Experience</h3>
            <form action="{{ route('product.review', $product->slug) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Your Name *</label>
                    <input type="text" name="customer_name" required value="{{ auth()->check() ? auth()->user()->name : '' }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Overall Rating *</label>
                    <select name="rating" required class="form-control" style="width: auto;">
                        <option value="5">★★★★★ (5 - Outstanding tactile quality)</option>
                        <option value="4">★★★★☆ (4 - Very good)</option>
                        <option value="3">★★★☆☆ (3 - Average)</option>
                        <option value="2">★★☆☆☆ (2 - Below expectations)</option>
                        <option value="1">★☆☆☆☆ (1 - Disappointed)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Review Headline</label>
                    <input type="text" name="title" placeholder="e.g. Perfectly cools water with earthy sweetness" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Your Detailed Review *</label>
                    <textarea name="body" rows="4" required placeholder="Tell other patrons how this piece feels in everyday rituals..." class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-dark">Submit Review</button>
            </form>
        </div>
    </section>

    <!-- Related Products Showcase (PDF item 18) -->
    @if($relatedProducts->isNotEmpty())
        <section style="margin-bottom: 5rem;">
            <div style="margin-bottom: 2rem;">
                <span class="text-uppercase text-xs text-clay">Complementary Craft</span>
                <h2 style="margin-top: 0.25rem;">Complete the Ritual</h2>
            </div>
            <div class="product-grid">
                @foreach($relatedProducts as $relProduct)
                    <x-product-card :product="$relProduct" />
                @endforeach
            </div>
        </section>
    @endif
</div>

<script>
    function incrementQty() {
        const input = document.getElementById('quantityInput');
        const max = parseInt(input.getAttribute('max')) || 99;
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }

    function decrementQty() {
        const input = document.getElementById('quantityInput');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function updateVariant(variantId, sku, price) {
        document.getElementById('selectedVariantId').value = variantId || '';
        document.getElementById('productSkuDisplay').textContent = sku;
        document.getElementById('priceDisplay').textContent = '₹' + parseFloat(price).toFixed(2);
    }

    function checkPincode() {
        const pin = document.getElementById('pincodeInput').value.trim();
        const resultDiv = document.getElementById('pincodeResult');
        if (!pin || pin.length < 6) {
            resultDiv.style.display = 'block';
            resultDiv.style.color = 'var(--color-danger)';
            resultDiv.textContent = 'Please enter a valid 6-digit Indian PIN code.';
            return;
        }

        fetch("{{ route('api.check-pincode') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ pincode: pin })
        })
        .then(res => res.json())
        .then(data => {
            resultDiv.style.display = 'block';
            if (data.serviceable) {
                resultDiv.style.color = 'var(--color-success)';
                resultDiv.innerHTML = `<strong>✓ Serviceable:</strong> ${data.message} Estimated arrival by <strong>${data.estimated_date}</strong>. Cash on Delivery is available.`;
            } else {
                resultDiv.style.color = 'var(--color-danger)';
                resultDiv.textContent = data.message || 'Delivery not available to this postal code.';
            }
        })
        .catch(err => {
            resultDiv.style.display = 'block';
            resultDiv.style.color = 'var(--color-danger)';
            resultDiv.textContent = 'Error checking pincode. Please try again.';
        });
    }
</script>

<style>
@media (max-width: 900px) {
    .pdp-layout {
        grid-template-columns: 1fr !important;
        gap: 2.5rem !important;
    }
}
</style>
@endsection

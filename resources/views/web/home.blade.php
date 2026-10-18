@extends('layouts.app')

@section('title', 'Oreon Living | Handcrafted Natural Earthen Clay & Terracotta')

@section('content')
<!-- 1. Hero Section -->
<section class="hero-slider" id="heroSlider">
    @forelse($banners as $index => $banner)
        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ $banner->image_url }}');">
            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="hero-bg-img" loading="eager">
            <div class="hero-overlay"></div>
            <div class="container" style="position: relative; z-index: 3;">
                <div class="hero-content">
                    @if($banner->badge_text)
                        <span class="badge badge-clay" style="margin-bottom: 1rem;">{{ $banner->badge_text }}</span>
                    @endif
                    <h1 class="heading-display" style="margin-bottom: 1.25rem;">{{ $banner->title }}</h1>
                    @if($banner->subtitle)
                        <p class="lead-text" style="margin-bottom: 2rem;">{{ $banner->subtitle }}</p>
                    @endif
                    <div class="flex gap-2" style="flex-wrap: wrap;">
                        <a href="{{ $banner->button_url }}" class="btn btn-primary btn-lg">{{ $banner->button_text }}</a>
                        <a href="{{ route('pages.about') }}" class="btn btn-secondary btn-lg">Our Craft Story</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="hero-slide active">
            <div class="container">
                <div class="hero-content">
                    <span class="badge badge-clay" style="margin-bottom: 1rem;">Autumn 2026</span>
                    <h1 class="heading-display" style="margin-bottom: 1.25rem;">Natural Materials. Thoughtful Design.</h1>
                    <p class="lead-text" style="margin-bottom: 2rem;">Hand-burnished alluvial clay water carafes, architectural planters, and slow-cooking vessels for everyday rituals.</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg">Explore All Pieces</a>
                </div>
            </div>
        </div>
    @endforelse
</section>

<!-- 2. Value Pillars (Minimalist Bar) -->
<section style="background-color: var(--color-surface); border-bottom: 1px solid var(--color-border); padding: 1.75rem 0;">
    <div class="container">
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); text-align: center; gap: 1.5rem;">
            <div>
                <p style="font-weight: 600; font-size: 0.9375rem; color: var(--color-text); margin-bottom: 0.25rem;">100% Lead-Free River Clay</p>
                <p style="font-size: 0.8125rem; color: var(--color-text-muted);">Porous, unglazed, and naturally alkaline</p>
            </div>
            <div>
                <p style="font-weight: 600; font-size: 0.9375rem; color: var(--color-text); margin-bottom: 0.25rem;">Zero-Breakage Guarantee</p>
                <p style="font-size: 0.8125rem; color: var(--color-text-muted);">Custom eco-cushioned transit packaging</p>
            </div>
            <div>
                <p style="font-weight: 600; font-size: 0.9375rem; color: var(--color-text); margin-bottom: 0.25rem;">Master Artisans of India</p>
                <p style="font-size: 0.8125rem; color: var(--color-text-muted);">Hand-thrown on slow village potters wheels</p>
            </div>
            <div>
                <p style="font-weight: 600; font-size: 0.9375rem; color: var(--color-text); margin-bottom: 0.25rem;">Free Pan-India Delivery</p>
                <p style="font-size: 0.8125rem; color: var(--color-text-muted);">Complimentary on all orders over ₹1,999</p>
            </div>
        </div>
    </div>
</section>

<!-- 3. Category Showcase -->
<section class="section">
    <div class="container">
        <div class="flex justify-between items-center" style="margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="text-uppercase text-xs text-clay">Curated Catalog</span>
                <h2 style="margin-top: 0.25rem;">Explore by Ritual</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="btn btn-secondary btn-sm">View All Categories &rarr;</a>
        </div>

        <div class="category-grid">
            @foreach($categories->take(3) as $category)
                <a href="{{ route('shop.category', $category->slug) }}" class="category-card">
                    <img src="{{ $category->image ?: 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $category->name }}" loading="lazy">
                    <div class="category-card-content">
                        <h3 class="category-card-title">{{ $category->name }}</h3>
                        <p style="font-size: 0.875rem; color: #E7E5E4; margin-bottom: 0.75rem; line-height: 1.4;">{{ $category->description }}</p>
                        <span class="category-card-link">Discover Collection &rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- 4. Featured Pieces Grid -->
<section class="section" style="background-color: var(--color-surface); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
    <div class="container">
        <div class="flex justify-between items-center" style="margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="text-uppercase text-xs text-clay">Artisan Spotlight</span>
                <h2 style="margin-top: 0.25rem;">Featured Clay Creations</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="btn btn-secondary btn-sm">View Full Collection &rarr;</a>
        </div>

        <div class="product-grid">
            @foreach($featuredProducts->take(4) as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</section>

<!-- 5. Editorial Brand Story: "The Breath of Terracotta" -->
<section class="section">
    <div class="container">
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); align-items: center; gap: 4rem;">
            <div style="position: relative;">
                <div style="aspect-ratio: 4/5; border-radius: var(--radius-sm); overflow: hidden; background-color: var(--color-surface-subtle);">
                    <img src="https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=1000&q=85" alt="Potter shaping clay" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
                <div style="position: absolute; bottom: -20px; right: -20px; background: #FAF7F2; padding: 1.5rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm); max-width: 240px; box-shadow: var(--shadow-card);" class="hide-mobile">
                    <p style="font-family: var(--font-display); font-size: 1.25rem; font-style: italic; color: var(--color-text);">"Clay is the memory of water and stone."</p>
                    <p style="font-size: 0.75rem; color: var(--color-clay); margin-top: 0.5rem; font-weight: 600;">&mdash; Master Potter Ramachandran</p>
                </div>
            </div>

            <div>
                <span class="text-uppercase text-xs text-clay">Philosophy & Material</span>
                <h2 style="margin: 0.5rem 0 1.25rem; font-size: clamp(2rem, 3.5vw, 2.75rem);">The Quiet Wisdom of Earth</h2>
                <p class="lead-text" style="margin-bottom: 1.25rem;">
                    In an age of synthetic coatings, steel, and microplastics, natural unglazed clay returns us to an intuitive equilibrium.
                </p>
                <p style="color: var(--color-text-muted); line-height: 1.8; margin-bottom: 1.5rem;">
                    Every Oreon Living vessel begins with unhurried alluvial clay gathered from clean river basins. Our terracotta is never kiln-sealed with synthetic chemical glazes; instead, its micro-porous walls breathe. Water stored in our carafes cools naturally via subtle evaporation, while our cooking handis circulate warmth slowly, preserving delicate nutrients and infusing meals with the calming aroma of first rain.
                </p>
                <div class="flex gap-2">
                    <a href="{{ route('pages.about') }}" class="btn btn-dark">Read Our Craft Story</a>
                    <a href="{{ route('shop.category', 'water-pots-and-carafes') }}" class="btn btn-secondary">Water Pots</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Best Sellers -->
<section class="section" style="background-color: var(--color-surface); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
    <div class="container">
        <div class="flex justify-between items-center" style="margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="text-uppercase text-xs text-clay">Most Cherished</span>
                <h2 style="margin-top: 0.25rem;">Everyday Bestsellers</h2>
            </div>
            <a href="{{ route('shop.index', ['sort' => 'bestseller']) }}" class="btn btn-secondary btn-sm">Explore All Bestsellers &rarr;</a>
        </div>

        <div class="product-grid">
            @foreach($bestsellers->take(4) as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</section>

<!-- 7. The 4-Step Craft Process -->
<section class="section">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 3.5rem;">
            <span class="text-uppercase text-xs text-clay">From Earth to Hearth</span>
            <h2 style="margin-top: 0.25rem;">The Handcrafted Journey</h2>
            <p class="text-muted" style="margin-top: 0.5rem;">Four deliberate stages honoring centuries of Indian ceramic heritage.</p>
        </div>

        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 2rem;">
            <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 2rem; border-radius: var(--radius-sm);">
                <span style="font-family: var(--font-display); font-size: 2.5rem; color: var(--color-clay); display: block; line-height: 1; margin-bottom: 0.75rem;">01</span>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Riverbed Harvesting</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6;">Filtered natural riverbed clays rich in iron and calcium, aged and wedged to eliminate trapped air.</p>
            </div>

            <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 2rem; border-radius: var(--radius-sm);">
                <span style="font-family: var(--font-display); font-size: 2.5rem; color: var(--color-clay); display: block; line-height: 1; margin-bottom: 0.75rem;">02</span>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Wheel Throwing</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6;">Shaped on manual potter wheels by master artisans whose lineage spans multiple generations of craft.</p>
            </div>

            <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 2rem; border-radius: var(--radius-sm);">
                <span style="font-family: var(--font-display); font-size: 2.5rem; color: var(--color-clay); display: block; line-height: 1; margin-bottom: 0.75rem;">03</span>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Stone Burnishing</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6;">Polished with smooth agate river stones while leather-hard to close pores without chemical sealants.</p>
            </div>

            <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 2rem; border-radius: var(--radius-sm);">
                <span style="font-family: var(--font-display); font-size: 2.5rem; color: var(--color-clay); display: block; line-height: 1; margin-bottom: 0.75rem;">04</span>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Wood-Fired Kiln</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6;">Baked under slow firewood flames at 900°C, bestowing natural terracotta hues and ring-tone strength.</p>
            </div>
        </div>
    </div>
</section>

<!-- 8. Testimonials Section -->
<section class="section" style="background-color: var(--color-surface-subtle); border-top: 1px solid var(--color-border);">
    <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto 3rem;">
            <span class="text-uppercase text-xs text-clay">In Living Spaces</span>
            <h2 style="margin-top: 0.25rem;">Reflections from Our Patrons</h2>
        </div>

        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
            @foreach($testimonials as $review)
                <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 2rem; border-radius: var(--radius-sm); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div class="flex gap-1" style="color: #D97706; margin-bottom: 1rem;">
                            @for($i = 0; $i < $review->rating; $i++)
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            @endfor
                        </div>
                        <h4 style="font-family: var(--font-display); font-size: 1.25rem; margin-bottom: 0.75rem; font-weight: 600;">"{{ $review->title }}"</h4>
                        <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 1.5rem;">{{ $review->body }}</p>
                    </div>
                    <div style="border-top: 1px solid var(--color-border-subtle); padding-top: 1rem; display: flex; justify-content: space-between; align-items: baseline;">
                        <span style="font-weight: 600; font-size: 0.875rem; color: var(--color-text);">{{ $review->customer_name }}</span>
                        @if($review->product)
                            <a href="{{ route('product.show', $review->product->slug) }}" style="font-size: 0.75rem; color: var(--color-clay);">{{ $review->product->name }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

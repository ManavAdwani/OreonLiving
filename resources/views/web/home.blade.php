@extends('layouts.app')

@section('title', 'Oréon Living | Natural Bio-Active Earthen Clay & Terracotta')

@section('content')
@php
    $heroBanner = $banners->first();
    $heroTitle = $heroBanner?->title ?? 'BRINGING NATURE to your HOME';
    $heroBadge = $heroBanner?->badge_text ?? 'RECONNECT WITH EARTH';
    $heroSub = $heroBanner?->subtitle ?? 'Micro-porous, lab-certified unglazed clayware crafted by multigenerational master potters. Naturally cooling, mineral-infusing, and 100% free from synthetic chemical glazes.';
    $heroImg = $heroBanner?->image_url ?? 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1200&q=85';
    $heroBtnText = $heroBanner?->button_text ?? 'Explore Collections';
    $heroBtnUrl = $heroBanner?->button_url ?? route('shop.index');
@endphp

<!-- 1. Asymmetric Editorial Hero (Klayvi Signature) -->
<section class="hero-editorial">
    <div class="container">
        <div class="hero-editorial-grid">
            <!-- Left: Typographic Narrative -->
            <div>
                <h6 class="kicker">{{ $heroBadge }}</h6>
                <h1 class="heading-display" style="margin: 0.75rem 0 1.5rem; letter-spacing: -0.02em;">
                    BRINGING NATURE<br>
                    <span style="font-style: italic; font-weight: 400; color: var(--color-clay);">to your</span> HOME
                </h1>
                <p class="lead-text" style="max-width: 580px; margin-bottom: 2.25rem;">
                    {{ $heroSub }}
                </p>
                <div class="flex items-center gap-3" style="flex-wrap: wrap;">
                    <a href="{{ $heroBtnUrl }}" class="btn btn-primary btn-lg">{{ $heroBtnText }}</a>
                    <a href="{{ route('pages.about') }}" class="hero-editorial-link">
                        Our Craft Philosophy <span class="arrow">&rarr;</span>
                    </a>
                </div>

                <!-- Purity Trust Markers -->
                <div class="hero-purity-pills">
                    <div class="hero-purity-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>100% Bio-Active Earth</span>
                    </div>
                    <div class="hero-purity-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Zero Heavy Metals (NABL)</span>
                    </div>
                    <div class="hero-purity-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>900°C Wood-Fired Strength</span>
                    </div>
                </div>
            </div>

            <!-- Right: Architectural Frame with Floating Badge & Parallax Depth -->
            <div style="position: relative;">
                <div class="hero-image-frame parallax-window">
                    <img src="{{ $heroImg }}" alt="Handcrafted bio-active terracotta carafe" class="parallax-img" data-parallax-speed="0.18" data-parallax-scale="1.15" loading="eager">
                </div>
                <div class="hero-editorial-badge parallax-layer" data-parallax-speed="-0.12">
                    <span style="display: block; font-size: 0.8125rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #FAF7F2; margin-bottom: 0.25rem;">
                        100% Bio-Active Earth
                    </span>
                    <span style="display: block; font-size: 0.75rem; color: #D6CEC5; line-height: 1.4;">
                        Lab-certified lead & cadmium free · NABL tested pure
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. The Earth Standard (Value Bar with Subtle Parallax Depth) -->
<section class="value-bar">
    <div class="container">
        <div class="value-bar-grid">
            <div class="value-bar-item parallax-layer" data-parallax-speed="0.04">
                <span class="value-bar-num">01 / Alkaline</span>
                <p class="value-bar-title">Natural Alkaline Balance</p>
                <p class="value-bar-desc">Gently neutralizes acidity (pH 7.8 - 8.2), infusing living water with natural minerals.</p>
            </div>
            <div class="value-bar-item parallax-layer" data-parallax-speed="0.08">
                <span class="value-bar-num">02 / Pure</span>
                <p class="value-bar-title">Zero Synthetic Toxins</p>
                <p class="value-bar-desc">100% lead, cadmium & PFAS free. Never sealed with artificial chemical varnishes.</p>
            </div>
            <div class="value-bar-item parallax-layer" data-parallax-speed="0.04">
                <span class="value-bar-num">03 / Lineage</span>
                <p class="value-bar-title">Multi-Generational Wheels</p>
                <p class="value-bar-desc">Turned by hand on slow village potter wheels, honoring 5,000 years of ceramic heritage.</p>
            </div>
            <div class="value-bar-item parallax-layer" data-parallax-speed="0.08">
                <span class="value-bar-num">04 / Safe</span>
                <p class="value-bar-title">Zero-Breakage Guarantee</p>
                <p class="value-bar-desc">Custom shock-cushioned transit casing with an instant, no-questions replacement promise.</p>
            </div>
        </div>
    </div>
</section>

<!-- 3. Curated Collections (Mosaic Grid with Staggered Parallax Depth) -->
<section class="section" style="overflow: hidden;">
    <div class="container">
        <div class="flex justify-between items-center" style="margin-bottom: 2.75rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h6 class="kicker">CURATED LIVING</h6>
                <h2 style="margin-top: 0.35rem; font-size: clamp(2rem, 3.8vw, 3rem);">
                    Our <span style="font-style: italic; color: var(--color-clay);">COLLECTIONS</span>
                </h2>
                <p class="text-muted" style="font-size: 0.9375rem; margin-top: 0.25rem;">Purposeful earthen vessels sculpted for modern spaces and ancient wellness rituals.</p>
            </div>
            <a href="{{ route('shop.index') }}" class="btn btn-secondary btn-sm">Explore All Categories &rarr;</a>
        </div>

        <div class="collections-mosaic">
            <!-- Tile 1: Water Pots & Carafes -->
            <a href="{{ route('shop.category', 'water-pots-and-carafes') }}" class="collection-tile parallax-window">
                <img src="https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=900&q=85" alt="Water Pots and Carafes" class="parallax-img" data-parallax-speed="0.14" data-parallax-scale="1.2" loading="lazy">
                <div class="collection-tile-overlay"></div>
                <div class="collection-tile-content">
                    <h3 class="collection-tile-title">Water Carafes & Coolers</h3>
                    <span class="collection-tile-sub">Naturally chilled, alkaline hydration &rarr;</span>
                </div>
            </a>

            <!-- Tile 2: Botanical Planters (Staggered higher speed for depth) -->
            <a href="{{ route('shop.category', 'botanical-planters') }}" class="collection-tile parallax-window">
                <img src="https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=900&q=85" alt="Botanical Planters" class="parallax-img" data-parallax-speed="0.22" data-parallax-scale="1.2" loading="lazy">
                <div class="collection-tile-overlay"></div>
                <div class="collection-tile-content">
                    <h3 class="collection-tile-title">Botanical Planters</h3>
                    <span class="collection-tile-sub">Breathable root aeration &rarr;</span>
                </div>
            </a>

            <!-- Tile 3: Earthen Cookware -->
            <a href="{{ route('shop.category', 'earthen-cookware') }}" class="collection-tile parallax-window">
                <img src="https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=900&q=85" alt="Earthen Cookware" class="parallax-img" data-parallax-speed="0.14" data-parallax-scale="1.2" loading="lazy">
                <div class="collection-tile-overlay"></div>
                <div class="collection-tile-content">
                    <h3 class="collection-tile-title">Clay Cookware</h3>
                    <span class="collection-tile-sub">Nutrient-preserving slow cooking &rarr;</span>
                </div>
            </a>

            <!-- Tile 4: Tableware & Dining -->
            <a href="{{ route('shop.category', 'serveware-and-tableware') }}" class="collection-tile parallax-window">
                <img src="https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=900&q=85" alt="Serveware & Tableware" class="parallax-img" data-parallax-speed="0.22" data-parallax-scale="1.2" loading="lazy">
                <div class="collection-tile-overlay"></div>
                <div class="collection-tile-content">
                    <h3 class="collection-tile-title">Tableware & Dining</h3>
                    <span class="collection-tile-sub">Earthen platters & tumblers &rarr;</span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- 4. Featured Pieces (Artisan Spotlight with Subtle Parallax Float) -->
<section class="section" style="background-color: var(--color-surface); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
    <div class="container">
        <div class="flex justify-between items-center" style="margin-bottom: 2.75rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h6 class="kicker">ARTISAN SPOTLIGHT</h6>
                <h2 style="margin-top: 0.35rem; font-size: clamp(2rem, 3.8vw, 3rem);">
                    Featured <span style="font-style: italic; color: var(--color-clay);">CREATIONS</span>
                </h2>
                <p class="text-muted" style="font-size: 0.9375rem; margin-top: 0.25rem;">Each vessel bears the subtle thumbprint of the master potter who shaped it on the wheel.</p>
            </div>
            <a href="{{ route('shop.index') }}" class="btn btn-secondary btn-sm">View Full Catalog &rarr;</a>
        </div>

        <div class="product-grid">
            @foreach($featuredProducts->take(4) as $index => $product)
                <div class="parallax-layer" data-parallax-speed="{{ $index % 2 === 0 ? '0.04' : '0.09' }}">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 5. Quote Immersion Banner (Klayvi Obsidian Contrast Break with Ambient Parallax Texture) -->
<section class="quote-banner-dark parallax-window" style="position: relative; overflow: hidden;">
    <div class="quote-parallax-bg parallax-img" data-parallax-speed="0.28" data-parallax-scale="1.25" style="position: absolute; inset: -20%; background: radial-gradient(circle at 65% 50%, rgba(184, 93, 59, 0.22) 0%, transparent 60%), url('https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=1600&q=70') center/cover no-repeat; opacity: 0.16; pointer-events: none; mix-blend-mode: luminosity;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="quote-banner-inner">
            <h6 class="kicker" style="color: var(--color-clay); margin-bottom: 1.5rem;">THE PHILOSOPHY</h6>
            <blockquote class="quote-banner-text">
                &ldquo;Clay is not merely inert soil. It breathes, absorbs, and cools. When water rests in porous earth, it returns to its living state.&rdquo;
            </blockquote>
            <p class="quote-banner-author">
                &mdash; RAMACHANDRAN K. &middot; 4TH GENERATION MASTER ARTISAN
            </p>
            <div style="margin-top: 2.5rem;">
                <a href="{{ route('pages.about') }}" class="btn btn-primary btn-sm">Discover Our Craft Philosophy &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- 6. The Zero-Toxin Standard (Trust Matrix) -->
<section class="section" style="background-color: var(--color-surface-subtle);">
    <div class="container">
        <div style="text-align: center; max-width: 680px; margin: 0 auto 3.5rem;">
            <h6 class="kicker">PURITY ASSURED</h6>
            <h2 style="margin-top: 0.35rem; font-size: clamp(2rem, 3.8vw, 3rem);">
                THE ZERO-TOXIN <span style="font-style: italic; color: var(--color-clay);">STANDARD</span>
            </h2>
            <p class="text-muted" style="font-size: 0.9375rem; margin-top: 0.5rem; line-height: 1.6;">
                Why health-conscious households choose bio-active, porous pottery over synthetic-coated cookware and plastics.
            </p>
        </div>

        <div class="trust-matrix-grid">
            <!-- Card 1 -->
            <div class="trust-matrix-card">
                <div class="trust-matrix-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.6rem; font-weight: 500;">100% Nutrient Retention</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6;">
                    Even heat circulation preserves sensitive vitamins, enzymes, and micro-nutrients often destroyed by high-temp metal pans.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="trust-matrix-card">
                <div class="trust-matrix-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.6rem; font-weight: 500;">Zero Microplastics & PFAS</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6;">
                    Never kiln-sealed with synthetic chemical glazes, teflon, or artificial lacquers. Only clean, raw, unglazed river earth.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="trust-matrix-card">
                <div class="trust-matrix-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M8 12h8"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.6rem; font-weight: 500;">Natural Alkaline Buffer</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6;">
                    Porous terracotta naturally buffers water acidity to a soothing pH 7.8 - 8.2, providing crisp hydration with zero electricity.
                </p>
            </div>

            <!-- Card 4 -->
            <div class="trust-matrix-card">
                <div class="trust-matrix-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 3"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.6rem; font-weight: 500;">River Stone Burnishing</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6;">
                    Polished with smooth agate river stones while leather-hard to seal pores naturally without chemical glass coatings.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 7. Everyday Bestsellers (with Parallax Elevation) -->
<section class="section" style="background-color: var(--color-surface); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
    <div class="container">
        <div class="flex justify-between items-center" style="margin-bottom: 2.75rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h6 class="kicker">MOST CHERISHED</h6>
                <h2 style="margin-top: 0.35rem; font-size: clamp(2rem, 3.8vw, 3rem);">
                    Everyday <span style="font-style: italic; color: var(--color-clay);">BESTSELLERS</span>
                </h2>
                <p class="text-muted" style="font-size: 0.9375rem; margin-top: 0.25rem;">Vessels that have found a cherished permanent place in over 5,000 households.</p>
            </div>
            <a href="{{ route('shop.index', ['sort' => 'bestseller']) }}" class="btn btn-secondary btn-sm">Explore All Bestsellers &rarr;</a>
        </div>

        <div class="product-grid">
            @foreach($bestsellers->take(4) as $index => $product)
                <div class="parallax-layer" data-parallax-speed="{{ $index % 2 === 0 ? '0.04' : '0.09' }}">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Visual Parallax Immersion Section: Living in Clay -->
<section class="parallax-immersion-banner parallax-window">
    <div class="parallax-immersion-img parallax-img" data-parallax-speed="0.26" data-parallax-scale="1.22" style="background-image: url('https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1800&q=85');"></div>
    <div class="parallax-immersion-overlay"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="parallax-immersion-content">
            <span class="kicker" style="color: var(--color-sand); letter-spacing: 0.16em;">TACTILE LIVING</span>
            <h2 class="parallax-immersion-title">
                VESSELS SHAPED BY<br>
                <span style="font-style: italic; color: #E6DFD5;">Sun, Water &amp; Woodfire</span>
            </h2>
            <p class="parallax-immersion-desc">
                Slow down. Feel the natural warmth of unglazed earth in everyday hydration and dining rituals.
            </p>
            <div style="margin-top: 1.75rem;">
                <a href="{{ route('shop.index') }}" class="btn btn-primary btn-sm" style="background-color: #FAF7F2; color: #1C1917; border-color: #FAF7F2;">
                    Experience The Collection &rarr;
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 8. Soil to Soul Heritage Split (Multi-Layer Parallax Depth) -->
<section class="soil-soul-section">
    <div class="container">
        <div class="soil-soul-grid">
            <div style="position: relative;">
                <div class="parallax-window" style="aspect-ratio: 4/5; border-radius: var(--radius-sm); overflow: hidden; background-color: var(--color-surface); box-shadow: var(--shadow-card);">
                    <img src="https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=1000&q=85" alt="Master artisan shaping terracotta on wheel" class="parallax-img" data-parallax-speed="0.20" data-parallax-scale="1.18" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
                <!-- Floating Artisan Lineage Stamp with Counter-Parallax -->
                <div class="heritage-parallax-badge parallax-layer" data-parallax-speed="-0.12">
                    <span style="display: block; font-size: 0.6875rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-clay); font-weight: 700;">HERITAGE WHEELS</span>
                    <span style="display: block; font-family: var(--font-display); font-size: 1.15rem; color: var(--color-text); font-weight: 600; margin-top: 2px;">5,000 BCE</span>
                    <span style="display: block; font-size: 0.75rem; color: var(--color-text-muted);">Vedic Clay Craft Lineage</span>
                </div>
            </div>

            <div>
                <h6 class="kicker">OUR HERITAGE</h6>
                <h2 style="margin: 0.5rem 0 1.25rem; font-size: clamp(2rem, 3.6vw, 3rem);">
                    From SOIL <span style="font-style: italic; color: var(--color-clay);">to</span> SOUL
                </h2>
                <p class="lead-text" style="margin-bottom: 1.25rem;">
                    In an age of disposable factory goods, Oréon Living re-anchors the home to the grounding serenity of earth.
                </p>
                <p style="color: var(--color-text-muted); line-height: 1.8; margin-bottom: 1.75rem;">
                    Every vessel begins with untouched alluvial clay harvested from river basins. Sun-cured for three weeks and hand-thrown on manual flywheels, each pot is wood-fired under firewood flames for 36 hours. Our pottery preserves centuries of Indian ceramic wisdom—designed to elevate your everyday rituals of water, food, and space.
                </p>
                
                <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 2rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.875rem; font-weight: 500; color: var(--color-text);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-clay)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Sourced from unpolluted riverbed alluvial deposits</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.875rem; font-weight: 500; color: var(--color-text);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-clay)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>36-hour slow wood-kiln firing at 900°C</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.875rem; font-weight: 500; color: var(--color-text);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-clay)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Direct patronage supporting multigenerational potter families</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('pages.about') }}" class="btn btn-dark">Our Craft Manifesto</a>
                    <a href="{{ route('shop.index') }}" class="btn btn-secondary">Explore All Vessels</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 9. Patrons' Reflections (Testimonials) -->
<section class="section" style="background-color: var(--color-surface); border-bottom: 1px solid var(--color-border);">
    <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto 3.5rem;">
            <h6 class="kicker">IN LIVING SPACES</h6>
            <h2 style="margin-top: 0.35rem; font-size: clamp(2rem, 3.8vw, 3rem);">
                Reflections from Our <span style="font-style: italic; color: var(--color-clay);">PATRONS</span>
            </h2>
            <p class="text-muted" style="margin-top: 0.5rem;">How our unglazed vessels bring mindfulness to homes across India.</p>
        </div>

        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
            @foreach($testimonials as $review)
                <div style="background-color: var(--color-surface-subtle); border: 1px solid var(--color-border); padding: 2.25rem 2rem; border-radius: var(--radius-sm); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div class="flex gap-1" style="color: var(--color-clay); margin-bottom: 1.25rem;">
                            @for($i = 0; $i < $review->rating; $i++)
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            @endfor
                        </div>
                        <h4 style="font-family: var(--font-display); font-size: 1.25rem; margin-bottom: 0.75rem; font-weight: 500; line-height: 1.35;">
                            &ldquo;{{ $review->title }}&rdquo;
                        </h4>
                        <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 1.5rem;">
                            {{ $review->body }}
                        </p>
                    </div>
                    <div style="border-top: 1px solid var(--color-border); padding-top: 1.25rem; display: flex; justify-content: space-between; align-items: baseline;">
                        <div>
                            <span style="font-weight: 600; font-size: 0.875rem; color: var(--color-text); display: block;">{{ $review->customer_name }}</span>
                            <span style="font-size: 0.75rem; color: var(--color-text-light);">Verified Patron</span>
                        </div>
                        @if($review->product)
                            <a href="{{ route('product.show', $review->product->slug) }}" style="font-size: 0.8125rem; color: var(--color-clay); font-weight: 500;">{{ $review->product->name }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 10. Community Dispatch (Newsletter) -->
<section class="section" style="background-color: var(--color-bg);">
    <div class="container">
        <div class="dispatch-box">
            <h6 class="kicker">COMMUNITY DISPATCH</h6>
            <h2 style="margin-top: 0.35rem; font-size: clamp(2rem, 3.5vw, 2.75rem);">
                Join the <span style="font-style: italic; color: var(--color-clay);">SOIL-TO-SOUL</span> Movement
            </h2>
            <p class="text-muted" style="max-width: 520px; margin: 0.75rem auto 0; font-size: 0.9375rem; line-height: 1.6;">
                Seasonal reflections on earthen living, slow pottery rituals, and priority invitations to limited kiln releases.
            </p>

            <form class="dispatch-form" action="#" method="POST" onsubmit="event.preventDefault(); alert('Thank you for subscribing to Oréon Living journal.'); this.reset();">
                <input type="email" class="dispatch-input" placeholder="Enter your email address" required aria-label="Email address">
                <button type="submit" class="btn btn-primary">Join Dispatch</button>
            </form>
        </div>
    </div>
</section>
@endsection

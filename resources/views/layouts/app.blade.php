<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = \App\Models\WebsiteSetting::get('site_name', 'Oréon Living');
        $siteTagline = \App\Models\WebsiteSetting::get('site_tagline', 'Natural Earthen Clay & Terracotta Lifestyle');
        $defaultMetaTitle = \App\Models\WebsiteSetting::get('meta_title_default', "{$siteName} | {$siteTagline}");
        $defaultMetaDesc = \App\Models\WebsiteSetting::get('meta_description_default', 'Discover handcrafted porous terracotta water carafes, botanical planters, and pure clay cookware. Mindfully designed for everyday living.');
        $googleSearchConsoleTag = \App\Models\WebsiteSetting::get('google_search_console_tag');
    @endphp

    <title>@yield('title', $defaultMetaTitle)</title>
    <meta name="description" content="@yield('meta_description', $defaultMetaDesc)">
    <link rel="canonical" href="{{ url()->current() }}">
    @if($googleSearchConsoleTag)
        <meta name="google-site-verification" content="{{ $googleSearchConsoleTag }}">
    @endif
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='45' fill='%23B85D3B'/><path d='M30 65 Q50 25 70 65' stroke='%23FAF7F2' stroke-width='8' fill='none'/></svg>">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Oréon Living | Modern Earthen Living')">
    <meta property="og:description" content="@yield('meta_description', 'Porous terracotta carafes, botanical planters, and kitchen handis crafted from pure riverbed clay.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-oreon-living.jpg'))">

    <!-- Google Fonts: Ibarra Real Nova (Display Serif) & Manrope (Clean Modern Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ibarra+Real+Nova:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Design System CSS -->
    <link rel="stylesheet" href="{{ asset('css/oreon.css') }}">

    <!-- Structured Data (Schema.org Organization & Store) -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "HomeGoodsStore",
      "name": "Oréon Living",
      "description": "Premium modern handcrafted earthen clay and terracotta home goods.",
      "url": "{{ url('/') }}",
      "telephone": "+919876543210",
      "priceRange": "₹499 - ₹5499",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "42 Pottery Lane, Heritage Crafts District",
        "addressLocality": "Bengaluru",
        "addressRegion": "Karnataka",
        "postalCode": "560001",
        "addressCountry": "IN"
      }
    }
    </script>

    @stack('head')
</head>
<body>
    @php
        $announcementEnabled = \App\Models\WebsiteSetting::get('announcement_bar_enabled', '1') !== '0';
        $announcementText = \App\Models\WebsiteSetting::get('announcement_bar_text', 'Complimentary pan-India delivery on orders above ₹1,999 • 100% Breakage-Free Guarantee');
        $announcementLink = \App\Models\WebsiteSetting::get('announcement_bar_link', route('shop.index'));
        $whatsappNumber = \App\Models\WebsiteSetting::get('whatsapp_number', '919876543210');
        $cartCount = app(\App\Services\CartService::class)->getCalculations()['items_count'] ?? 0;
    @endphp

    <!-- Announcement Bar -->
    @if($announcementEnabled && $announcementText)
    <div class="announcement-bar">
        <span>{{ $announcementText }}</span>
        @if($announcementLink)
            <a href="{{ $announcementLink }}">Explore Collection &rarr;</a>
        @endif
    </div>
    @endif

    <!-- Global Header / Navbar -->
    <header class="site-header" id="siteHeader">
        <div class="container">
            <div class="nav-container">
                <!-- Mobile Toggle -->
                <button class="mobile-nav-toggle" id="mobileMenuBtn" aria-label="Toggle navigation menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>

                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="brand-logo">
                    <span class="logo-title">ORÉON LIVING</span>
                    <span class="logo-subtitle">SOIL &middot; CRAFT &middot; FORM</span>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="nav-links" id="navLinks">
                    <a href="{{ route('shop.index') }}" class="{{ request()->routeIs('shop.*') ? 'active' : '' }}">Shop All</a>
                    <a href="{{ route('shop.category', 'water-pots-and-carafes') }}">Water Carafes</a>
                    <a href="{{ route('shop.category', 'botanical-planters') }}">Planters</a>
                    <a href="{{ route('shop.category', 'earthen-cookware') }}">Cookware</a>
                    <a href="{{ route('pages.about') }}" class="{{ request()->routeIs('pages.about') ? 'active' : '' }}">Our Craft</a>
                    <a href="{{ route('pages.faq') }}" class="{{ request()->routeIs('pages.faq') ? 'active' : '' }}">FAQ</a>
                </nav>

                <!-- Utility Actions -->
                <div class="nav-actions">
                    <!-- Search -->
                    <a href="{{ route('search') }}" class="nav-icon-btn" title="Search catalogue" aria-label="Search">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </a>

                    <!-- Wishlist -->
                    <a href="{{ route('wishlist.index') }}" class="nav-icon-btn" title="Saved pieces" aria-label="Wishlist">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </a>

                    <!-- Account / Staff -->
                    @auth
                        <a href="{{ auth()->user()->isStaff() ? route('admin.dashboard') : route('account.dashboard') }}" class="nav-icon-btn" title="My Account" aria-label="Account">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-icon-btn" title="Sign in" aria-label="Login">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </a>
                    @endauth

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="nav-icon-btn" title="Shopping Cart" aria-label="Cart">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-2z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                        <span class="nav-badge" id="cartBadge" style="{{ $cartCount > 0 ? '' : 'display:none;' }}">{{ $cartCount }}</span>
                    </a>
                </div>
            </div>
    </header>

    <!-- Mobile Drawer & Backdrop -->
    <div class="mobile-drawer-backdrop" id="mobileDrawerBackdrop"></div>
    <aside class="mobile-drawer" id="mobileDrawer" aria-label="Mobile Navigation Drawer">
        <div class="mobile-drawer-header">
            <a href="{{ route('home') }}" class="brand-logo" onclick="closeMobileDrawer()">
                <span class="logo-title" style="font-size: 1.4rem;">ORÉON LIVING</span>
                <span class="logo-subtitle" style="font-size: 0.55rem;">SOIL &middot; CRAFT &middot; FORM</span>
            </a>
            <button type="button" class="mobile-drawer-close" id="mobileDrawerClose" aria-label="Close menu">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="mobile-drawer-search">
            <form action="{{ route('search') }}" method="GET">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="search" name="q" placeholder="Search clay cookware, planters, carafes..." value="{{ request('q') }}">
            </form>
        </div>

        <div class="mobile-drawer-body">
            <div class="mobile-drawer-section-title">Shop Collections</div>
            <ul class="mobile-drawer-links">
                <li><a href="{{ route('shop.index') }}"><span>Shop All Pieces</span> <span style="color: var(--color-clay);">&rarr;</span></a></li>
                <li><a href="{{ route('shop.category', 'water-pots-and-carafes') }}"><span>Water Pots & Carafes</span> <span>&rsaquo;</span></a></li>
                <li><a href="{{ route('shop.category', 'botanical-planters') }}"><span>Botanical Planters</span> <span>&rsaquo;</span></a></li>
                <li><a href="{{ route('shop.category', 'earthen-cookware') }}"><span>Clay Cookware & Handis</span> <span>&rsaquo;</span></a></li>
                <li><a href="{{ route('shop.category', 'serveware-and-tableware') }}"><span>Serveware & Tableware</span> <span>&rsaquo;</span></a></li>
                <li><a href="{{ route('shop.category', 'sculptural-vases') }}"><span>Sculptural Vases</span> <span>&rsaquo;</span></a></li>
                <li><a href="{{ route('shop.category', 'ritual-diyas-and-lamps') }}"><span>Ritual Diyas & Lamps</span> <span>&rsaquo;</span></a></li>
            </ul>

            <div class="mobile-drawer-section-title">The Studio & Care</div>
            <ul class="mobile-drawer-links">
                <li><a href="{{ route('pages.about') }}"><span>Our Craft Philosophy</span> <span>&rsaquo;</span></a></li>
                <li><a href="{{ route('pages.faq') }}"><span>Clay Seasoning & FAQs</span> <span>&rsaquo;</span></a></li>
                <li><a href="{{ route('pages.shipping-policy') }}"><span>100% Breakage Guarantee</span> <span>&rsaquo;</span></a></li>
                <li><a href="{{ route('pages.contact') }}"><span>Contact Studio Concierge</span> <span>&rsaquo;</span></a></li>
            </ul>

            <div class="mobile-drawer-section-title">Patron Sanctuary</div>
            <ul class="mobile-drawer-links">
                @auth
                    <li><a href="{{ auth()->user()->isStaff() ? route('admin.dashboard') : route('account.dashboard') }}"><span>My Account ({{ auth()->user()->name }})</span> <span>&rsaquo;</span></a></li>
                    <li><a href="{{ route('account.orders') }}"><span>My Orders</span> <span>&rsaquo;</span></a></li>
                    <li><a href="{{ route('wishlist.index') }}"><span>Saved Pieces (Wishlist)</span> <span>&rsaquo;</span></a></li>
                    <li><a href="{{ route('cart.index') }}"><span>Cart ({{ $cartCount }})</span> <span style="font-weight: 600; color: var(--color-clay);">View</span></a></li>
                @else
                    <li><a href="{{ route('login') }}"><span>Sign In / Create Account</span> <span>&rsaquo;</span></a></li>
                    <li><a href="{{ route('wishlist.index') }}"><span>Wishlist</span> <span>&rsaquo;</span></a></li>
                    <li><a href="{{ route('cart.index') }}"><span>Cart ({{ $cartCount }})</span> <span style="font-weight: 600; color: var(--color-clay);">View</span></a></li>
                @endauth
            </ul>
        </div>

        <div class="mobile-drawer-footer">
            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello Oréon Living, I have a question about your earthen collections.') }}" target="_blank" rel="noopener" class="btn btn-block" style="background: #25D366; color: #fff; font-size: 0.85rem; padding: 0.75rem 1rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block; vertical-align:middle; margin-right: 6px;"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                WhatsApp Artisan Concierge
            </a>
        </div>
    </aside>

    <!-- Flash Messages -->
    <div class="container" style="margin-top: 1rem;">
        @if(session('success'))
            <div class="alert alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                <span>{{ session('info') }}</span>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Floating WhatsApp Concierge Button (PDF item 26, 148, 151) -->
    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello Oréon Living, I would like to inquire about your earthen clay collections.') }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="whatsapp-floating" 
       title="Chat with Clay Concierge">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
        </svg>
    </a>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <span style="font-family: var(--font-display); font-size: 1.85rem; letter-spacing: 0.04em; color: #FAF7F2; display: block; margin-bottom: 0.5rem;">ORÉON LIVING</span>
                    <p style="font-size: 0.875rem; color: #A8A29E; line-height: 1.7; max-width: 320px; margin-bottom: 1.5rem;">
                        Natural materials. Thoughtful design. Made for everyday living. Handcrafted from indigenous riverbed clay to bring serenity to your home.
                    </p>
                    <div class="flex gap-2" style="flex-wrap: wrap;">
                        <a href="{{ \App\Models\WebsiteSetting::get('instagram_url', '#') }}" target="_blank" rel="noopener" style="color: #D4CCC1; font-size: 0.8125rem;">Instagram</a>
                        <span style="color: #57534E;">&bull;</span>
                        <a href="{{ \App\Models\WebsiteSetting::get('facebook_url', '#') }}" target="_blank" rel="noopener" style="color: #D4CCC1; font-size: 0.8125rem;">Facebook</a>
                        @if($pUrl = \App\Models\WebsiteSetting::get('pinterest_url'))
                            <span style="color: #57534E;">&bull;</span>
                            <a href="{{ $pUrl }}" target="_blank" rel="noopener" style="color: #D4CCC1; font-size: 0.8125rem;">Pinterest</a>
                        @endif
                        @if($ytUrl = \App\Models\WebsiteSetting::get('youtube_url'))
                            <span style="color: #57534E;">&bull;</span>
                            <a href="{{ $ytUrl }}" target="_blank" rel="noopener" style="color: #D4CCC1; font-size: 0.8125rem;">YouTube</a>
                        @endif
                        <span style="color: #57534E;">&bull;</span>
                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" rel="noopener" style="color: #D4CCC1; font-size: 0.8125rem;">WhatsApp</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Collections</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('shop.category', 'water-pots-and-carafes') }}">Water Pots & Carafes</a></li>
                        <li><a href="{{ route('shop.category', 'botanical-planters') }}">Botanical Planters</a></li>
                        <li><a href="{{ route('shop.category', 'earthen-cookware') }}">Clay Cookware</a></li>
                        <li><a href="{{ route('shop.category', 'serveware-and-tableware') }}">Serveware & Tableware</a></li>
                        <li><a href="{{ route('shop.category', 'sculptural-vases') }}">Sculptural Vases</a></li>
                        <li><a href="{{ route('shop.category', 'ritual-diyas-and-lamps') }}">Ritual Diyas</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Company & Care</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('pages.about') }}">Our Craft Philosophy</a></li>
                        <li><a href="{{ route('pages.faq') }}">Clay Care & Seasoning</a></li>
                        <li><a href="{{ route('pages.shipping-policy') }}">100% Breakage Guarantee</a></li>
                        <li><a href="{{ route('pages.return-policy') }}">Returns & Replacements</a></li>
                        <li><a href="{{ route('pages.contact') }}">Concierge Studio</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Mindful Living Dispatch</h4>
                    <p style="font-size: 0.8125rem; color: #A8A29E; margin-bottom: 1rem; line-height: 1.6;">
                        Receive seasonal dispatches on earthen pottery rituals, artisan interviews, and early access to limited kilns.
                    </p>
                    <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Thank you for subscribing to Oréon Living journal.'); this.reset();" style="display: flex; gap: 0.5rem;">
                        <input type="email" placeholder="Your email address" required style="flex:1; padding: 0.75rem 1rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: var(--radius-sm); color: #FFF; font-size: 0.875rem;">
                        <button type="submit" class="btn btn-primary btn-sm">Join</button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Oréon Living Private Limited. All rights reserved.</p>
                <div class="flex gap-3">
                    <a href="{{ route('pages.privacy-policy') }}">Privacy Policy</a>
                    <a href="{{ route('pages.terms') }}">Terms & Conditions</a>
                    <a href="{{ route('pages.shipping-policy') }}">Shipping Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vanilla JS Interactivity -->
    <script>
        // Sticky Header Effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('siteHeader');
            if (header) {
                if (window.scrollY > 20) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
        });

        // Mobile Drawer Controller
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileDrawer = document.getElementById('mobileDrawer');
        const mobileDrawerBackdrop = document.getElementById('mobileDrawerBackdrop');
        const mobileDrawerClose = document.getElementById('mobileDrawerClose');

        function openMobileDrawer() {
            if (mobileDrawer && mobileDrawerBackdrop) {
                mobileDrawer.classList.add('active');
                mobileDrawerBackdrop.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeMobileDrawer() {
            if (mobileDrawer && mobileDrawerBackdrop) {
                mobileDrawer.classList.remove('active');
                mobileDrawerBackdrop.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', openMobileDrawer);
        }
        if (mobileDrawerClose) {
            mobileDrawerClose.addEventListener('click', closeMobileDrawer);
        }
        if (mobileDrawerBackdrop) {
            mobileDrawerBackdrop.addEventListener('click', closeMobileDrawer);
        }
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileDrawer && mobileDrawer.classList.contains('active')) {
                closeMobileDrawer();
            }
        });

        // Global AJAX Wishlist Toggle
        function toggleWishlist(productId, btnElement) {
            fetch(`/wishlist/toggle/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => {
                if (res.status === 401) {
                    window.location.href = "{{ route('login') }}";
                    return;
                }
                return res.json();
            })
            .then(data => {
                if (!data) return;
                if (data.success) {
                    if (data.added) {
                        btnElement.classList.add('active');
                        btnElement.querySelector('svg').setAttribute('fill', 'var(--color-clay)');
                        btnElement.querySelector('svg').setAttribute('stroke', 'var(--color-clay)');
                    } else {
                        btnElement.classList.remove('active');
                        btnElement.querySelector('svg').setAttribute('fill', 'none');
                        btnElement.querySelector('svg').setAttribute('stroke', 'currentColor');
                    }
                }
            })
            .catch(err => console.error(err));
        }

        // Global Quick Add to Cart
        function quickAddToCart(productId) {
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', 1);

            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const badge = document.getElementById('cartBadge');
                    if (badge) {
                        badge.textContent = data.items_count;
                        badge.style.display = 'flex';
                    }
                    showToast(data.message);
                } else {
                    alert(data.message || 'Unable to add item to cart.');
                }
            })
            .catch(err => console.error(err));
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.style.position = 'fixed';
            toast.style.bottom = '90px';
            toast.style.right = '28px';
            toast.style.backgroundColor = 'var(--color-text)';
            toast.style.color = '#FFFFFF';
            toast.style.padding = '0.9rem 1.4rem';
            toast.style.borderRadius = 'var(--radius-sm)';
            toast.style.boxShadow = 'var(--shadow-card)';
            toast.style.zIndex = '9999';
            toast.style.fontSize = '0.875rem';
            toast.style.fontWeight = '500';
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        /* ==========================================================================
           Vertical Parallax Depth Engine (High-Performance GPU-Accelerated)
           ========================================================================== */
        (function() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                return;
            }

            const parallaxElements = [];
            const selector = '[data-parallax-speed], .parallax-img, .parallax-layer';
            
            function registerElements() {
                const elements = document.querySelectorAll(selector);
                parallaxElements.length = 0;

                elements.forEach(el => {
                    const speed = parseFloat(el.getAttribute('data-parallax-speed')) || 0.15;
                    const scale = parseFloat(el.getAttribute('data-parallax-scale')) || 1;
                    const maxOffset = parseFloat(el.getAttribute('data-parallax-max')) || 160;
                    const direction = el.getAttribute('data-parallax-dir') || 'vertical';

                    parallaxElements.push({
                        el,
                        speed,
                        scale,
                        maxOffset,
                        direction,
                        isVisible: true
                    });
                });
            }

            // Viewport intersection observer to avoid computing offscreen elements
            let observer;
            if ('IntersectionObserver' in window) {
                observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        const match = parallaxElements.find(item => item.el === entry.target);
                        if (match) {
                            match.isVisible = entry.isIntersecting;
                        }
                    });
                }, {
                    rootMargin: '120px 0px 120px 0px'
                });
            }

            let ticking = false;
            let windowHeight = window.innerHeight;
            const isMobile = window.innerWidth <= 768;
            const mobileFactor = isMobile ? 0.6 : 1.0;

            function updateParallax() {
                const viewportCenter = windowHeight / 2;

                for (let i = 0; i < parallaxElements.length; i++) {
                    const item = parallaxElements[i];
                    if (!item.isVisible) continue;

                    const rect = item.el.getBoundingClientRect();
                    const elementCenter = rect.top + rect.height / 2;
                    const distanceFromCenter = elementCenter - viewportCenter;

                    let offset = distanceFromCenter * item.speed * mobileFactor;

                    if (item.maxOffset) {
                        offset = Math.max(-item.maxOffset, Math.min(item.maxOffset, offset));
                    }

                    const scaleStr = item.scale !== 1 ? ` scale(${item.scale})` : '';

                    if (item.direction === 'vertical') {
                        item.el.style.transform = `translate3d(0, ${offset.toFixed(2)}px, 0)${scaleStr}`;
                    } else if (item.direction === 'horizontal') {
                        item.el.style.transform = `translate3d(${offset.toFixed(2)}px, 0, 0)${scaleStr}`;
                    }
                }

                ticking = false;
            }

            function requestParallaxTick() {
                if (!ticking) {
                    window.requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            }

            window.addEventListener('scroll', requestParallaxTick, { passive: true });
            window.addEventListener('resize', function() {
                windowHeight = window.innerHeight;
                requestParallaxTick();
            }, { passive: true });

            // Initialize
            registerElements();
            if (observer) {
                parallaxElements.forEach(item => observer.observe(item.el));
            }
            requestParallaxTick();
        })();
    </script>

    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Oreon Living | Natural Earthen Clay & Terracotta Lifestyle')</title>
    <meta name="description" content="@yield('meta_description', 'Discover handcrafted porous terracotta water carafes, botanical planters, and pure clay cookware. Mindfully designed for everyday living.')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Oreon Living | Modern Earthen Living')">
    <meta property="og:description" content="@yield('meta_description', 'Porous terracotta carafes, botanical planters, and kitchen handis crafted from pure riverbed clay.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-oreon-living.jpg'))">

    <!-- Google Fonts: Cormorant Garamond & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Design System CSS -->
    <link rel="stylesheet" href="{{ asset('css/oreon.css') }}">

    <!-- Structured Data (Schema.org Organization & Store) -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "HomeGoodsStore",
      "name": "Oreon Living",
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
        $announcementText = \App\Models\WebsiteSetting::get('announcement_bar_text', 'Complimentary pan-India delivery on orders above ₹1,999 • 100% Breakage-Free Guarantee');
        $whatsappNumber = \App\Models\WebsiteSetting::get('whatsapp_number', '919876543210');
        $cartCount = app(\App\Services\CartService::class)->getCalculations()['items_count'] ?? 0;
    @endphp

    <!-- Announcement Bar -->
    @if($announcementText)
    <div class="announcement-bar">
        <span>{{ $announcementText }}</span>
        <a href="{{ route('shop.index') }}">Explore Collection &rarr;</a>
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
                    <span class="logo-title">OREON LIVING</span>
                    <span class="logo-subtitle">EARTH &middot; CRAFT &middot; FORM</span>
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
        </div>
    </header>

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
    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello Oreon Living, I would like to inquire about your earthen clay collections.') }}" 
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
                    <span style="font-family: var(--font-display); font-size: 1.85rem; letter-spacing: 0.04em; color: #FAF7F2; display: block; margin-bottom: 0.5rem;">OREON LIVING</span>
                    <p style="font-size: 0.875rem; color: #A8A29E; line-height: 1.7; max-width: 320px; margin-bottom: 1.5rem;">
                        Natural materials. Thoughtful design. Made for everyday living. Handcrafted from indigenous riverbed clay to bring serenity to your home.
                    </p>
                    <div class="flex gap-2">
                        <a href="{{ \App\Models\WebsiteSetting::get('instagram_url', '#') }}" target="_blank" rel="noopener" style="color: #D4CCC1; font-size: 0.8125rem;">Instagram</a>
                        <span style="color: #57534E;">&bull;</span>
                        <a href="{{ \App\Models\WebsiteSetting::get('facebook_url', '#') }}" target="_blank" rel="noopener" style="color: #D4CCC1; font-size: 0.8125rem;">Facebook</a>
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
                    <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Thank you for subscribing to Oreon Living journal.'); this.reset();" style="display: flex; gap: 0.5rem;">
                        <input type="email" placeholder="Your email address" required style="flex:1; padding: 0.75rem 1rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: var(--radius-sm); color: #FFF; font-size: 0.875rem;">
                        <button type="submit" class="btn btn-primary btn-sm">Join</button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Oreon Living Private Limited. All rights reserved.</p>
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

        // Mobile Menu Toggle
        const menuBtn = document.getElementById('mobileMenuBtn');
        const navLinks = document.getElementById('navLinks');
        if (menuBtn && navLinks) {
            menuBtn.addEventListener('click', () => {
                if (navLinks.style.display === 'flex') {
                    navLinks.style.display = 'none';
                } else {
                    navLinks.style.display = 'flex';
                    navLinks.style.flexDirection = 'column';
                    navLinks.style.position = 'absolute';
                    navLinks.style.top = '100%';
                    navLinks.style.left = '0';
                    navLinks.style.right = '0';
                    navLinks.style.background = '#FAF7F2';
                    navLinks.style.padding = '1.5rem';
                    navLinks.style.borderBottom = '1px solid var(--color-border)';
                    navLinks.style.boxShadow = 'var(--shadow-card)';
                }
            });
        }

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
    </script>

    @stack('scripts')
</body>
</html>

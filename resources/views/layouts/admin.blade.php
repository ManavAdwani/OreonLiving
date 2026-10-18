<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | Oreon Living Administration</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/oreon.css') }}">

    @stack('head')
</head>
<body class="admin-body">
    <!-- Sidebar Navigation with Granular RBAC (PDF items 51-57, 101, 102) -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar-brand">
            <span class="admin-brand-title">OREON LIVING</span>
            <span class="admin-brand-badge">STAFF PORTAL</span>
        </div>

        <nav class="admin-sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                <span>Dashboard</span>
            </a>

            <!-- Catalogue Management (Product Manager, Viewer, Super Admin) -->
            @if(auth()->user()->canAccessSection('products'))
                <span class="admin-nav-category">Catalogue</span>
                <a href="{{ route('admin.products.index') }}" class="admin-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span>Products</span>
                </a>
            @endif

            @if(auth()->user()->canAccessSection('categories'))
                <a href="{{ route('admin.categories.index') }}" class="admin-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    <span>Categories</span>
                </a>
            @endif

            <!-- Sales & Orders (Order Manager, Customer Support, Viewer, Super Admin) -->
            @if(auth()->user()->canAccessSection('orders'))
                <span class="admin-nav-category">Fulfillment</span>
                <a href="{{ route('admin.orders.index') }}" class="admin-nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <span>Orders</span>
                </a>
            @endif

            @if(auth()->user()->canAccessSection('customers'))
                <a href="{{ route('admin.customers.index') }}" class="admin-nav-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Customers</span>
                </a>
            @endif

            <!-- Marketing (Marketing Manager, Viewer, Super Admin) -->
            @if(auth()->user()->canAccessSection('coupons'))
                <span class="admin-nav-category">Marketing</span>
                <a href="{{ route('admin.coupons.index') }}" class="admin-nav-item {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                    <span>Coupons &amp; Offers</span>
                </a>
            @endif

            @if(auth()->user()->canAccessSection('reviews'))
                <a href="{{ route('admin.reviews.index') }}" class="admin-nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <span>Review Moderation</span>
                </a>
            @endif

            <!-- Content (Content Manager, Viewer, Super Admin) -->
            @if(auth()->user()->canAccessSection('content'))
                <span class="admin-nav-category">Website Content</span>
                <a href="{{ route('admin.banners.index') }}" class="admin-nav-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span>Hero Banners</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="admin-nav-item {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    <span>FAQ Articles</span>
                </a>
            @endif

            <!-- Customer Inquiries (Customer Support, Viewer, Super Admin) -->
            @if(auth()->user()->canAccessSection('support'))
                <span class="admin-nav-category">Concierge Leads</span>
                <a href="{{ route('admin.contacts.index') }}" class="admin-nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    <span>Contact Inquiries</span>
                </a>
            @endif

            <!-- System Administration (Super Admin Only) -->
            @if(auth()->user()->isSuperAdmin())
                <span class="admin-nav-category">Administration</span>
                <a href="{{ route('admin.staff.index') }}" class="admin-nav-item {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <span>Staff Accounts &amp; RBAC</span>
                </a>
                <a href="{{ route('admin.activity-logs.index') }}" class="admin-nav-item {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    <span>Audit Trail Logs</span>
                </a>
            @endif
        </nav>

        <!-- Sidebar User Footer -->
        <div class="admin-sidebar-footer">
            <div class="admin-user-info">
                <strong>{{ auth()->user()->name }}</strong>
                <div class="admin-user-role">{{ str_replace('_', ' ', auth()->user()->role) }}</div>
            </div>
            <div class="flex justify-between items-center" style="margin-top: 0.75rem;">
                <a href="{{ route('home') }}" target="_blank" style="font-size: 0.75rem; color: #D6D3D1; text-decoration: underline;">View Live Store &nearr;</a>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="font-size: 0.75rem; color: #F87171; background: none; border: none; cursor: pointer;">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Admin Main Body -->
    <div class="admin-main">
        <header class="admin-header">
            <h2 style="font-size: 1.15rem; font-weight: 600;">@yield('header_title', 'Staff Dashboard')</h2>
            <div class="flex items-center gap-2">
                <span class="status-pill status-confirmed">{{ str_replace('_', ' ', auth()->user()->role) }}</span>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary btn-sm">Public Storefront &nearr;</a>
            </div>
        </header>

        <div class="admin-content">
            <!-- Flash messages -->
            @if(session('success'))
                <div class="alert alert-success" style="margin-bottom: 1.5rem;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>

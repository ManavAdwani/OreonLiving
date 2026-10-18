@extends('layouts.app')

@section('title', 'All Earthen Collections | Oreon Living')
@section('meta_description', 'Explore handcrafted terracotta water pots, botanical planters, and pure clay cookware for modern living.')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <span>Shop All</span>
    </nav>

    <!-- Header -->
    <div class="flex justify-between items-center" style="margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: clamp(2rem, 3.5vw, 2.75rem);">Earthen Collections</h1>
            <p class="text-muted" style="margin-top: 0.25rem;">Showing {{ $products->total() }} pieces handcrafted from natural terracotta</p>
        </div>

        <!-- Sorting -->
        <form method="GET" action="{{ route('shop.index') }}" id="sortForm">
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if(request('min_price')) <input type="hidden" name="min_price" value="{{ request('min_price') }}"> @endif
            @if(request('max_price')) <input type="hidden" name="max_price" value="{{ request('max_price') }}"> @endif
            @if(request('in_stock')) <input type="hidden" name="in_stock" value="{{ request('in_stock') }}"> @endif

            <div class="flex items-center gap-1">
                <label for="sortSelect" style="font-size: 0.8125rem; color: var(--color-text-muted); font-weight: 500;">Sort By:</label>
                <select name="sort" id="sortSelect" onchange="this.form.submit()" class="form-control" style="width: auto; padding: 0.5rem 1rem; font-size: 0.875rem;">
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                    <option value="bestseller" {{ $sort === 'bestseller' ? 'selected' : '' }}>Bestsellers</option>
                    <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Layout: Sidebar Filters + Products Grid -->
    <div class="shop-layout">
        <!-- Mobile Filter Toggle Button -->
        <button type="button" class="btn btn-secondary btn-block hide-desktop" onclick="const sb = document.getElementById('shopSidebar'); sb.style.display = sb.style.display === 'block' ? 'none' : 'block';" style="margin-bottom: 0.5rem; display: flex; justify-content: space-between; align-items: center;">
            <span>Filter Pieces by Category & Price</span>
            <span>&darr;</span>
        </button>

        <!-- Sidebar Filters -->
        <aside id="shopSidebar" class="shop-sidebar" style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 1.5rem; border-radius: var(--radius-sm);">
            <div class="flex justify-between items-center" style="margin-bottom: 1.25rem;">
                <h4 style="font-family: var(--font-body); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 600;">Filters</h4>
                <a href="{{ route('shop.index') }}" style="font-size: 0.75rem; color: var(--color-clay); text-decoration: underline;">Reset All</a>
            </div>

            <!-- Categories Filter -->
            <div style="margin-bottom: 1.75rem;">
                <h5 style="font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted); margin-bottom: 0.75rem; font-weight: 600;">Category</h5>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.5rem;">
                    <li>
                        <a href="{{ route('shop.index', array_merge(request()->except('category', 'page'))) }}" 
                           style="font-size: 0.875rem; color: {{ !request('category') ? 'var(--color-clay); font-weight:600;' : 'var(--color-text)' }}">
                            All Categories
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('shop.index', array_merge(request()->except('category', 'page'), ['category' => $cat->slug])) }}" 
                               style="font-size: 0.875rem; color: {{ request('category') === $cat->slug ? 'var(--color-clay); font-weight:600;' : 'var(--color-text)' }}; display: flex; justify-content: space-between;">
                                <span>{{ $cat->name }}</span>
                                <span style="font-size: 0.75rem; color: var(--color-text-light);">({{ $cat->products()->count() }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Price Filter -->
            <form method="GET" action="{{ route('shop.index') }}">
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                <div style="margin-bottom: 1.75rem;">
                    <h5 style="font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted); margin-bottom: 0.75rem; font-weight: 600;">Price Range (₹)</h5>
                    <div class="flex gap-1" style="margin-bottom: 0.75rem;">
                        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="form-control" style="padding: 0.4rem 0.6rem; font-size: 0.8125rem;">
                        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="form-control" style="padding: 0.4rem 0.6rem; font-size: 0.8125rem;">
                    </div>
                    <button type="submit" class="btn btn-secondary btn-sm btn-block">Apply Price</button>
                </div>

                <!-- Stock Filter -->
                <div style="margin-bottom: 1rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; cursor: pointer;">
                        <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') === '1' ? 'checked' : '' }} onchange="this.form.submit()">
                        <span>In Stock Only</span>
                    </label>
                </div>
            </form>
        </aside>

        <!-- Products Listing -->
        <div>
            @if($products->isEmpty())
                <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 4rem 2rem; border-radius: var(--radius-sm); text-align: center;">
                    <h3 style="margin-bottom: 0.5rem;">No Pieces Found</h3>
                    <p class="text-muted" style="margin-bottom: 1.5rem;">Try adjusting your selected filters or price range.</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-secondary">Clear All Filters</a>
                </div>
            @else
                <div class="product-grid">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div style="margin-top: 3.5rem; display: flex; justify-content: center;">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

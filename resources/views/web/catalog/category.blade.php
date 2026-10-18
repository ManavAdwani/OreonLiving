@extends('layouts.app')

@section('title', $category->name . ' | Oreon Living')
@section('meta_description', $category->description ?? 'Discover handcrafted ' . strtolower($category->name) . ' by Oreon Living.')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('shop.index') }}">Shop</a>
        <span class="breadcrumb-separator">/</span>
        <span>{{ $category->name }}</span>
    </nav>

    <!-- Category Editorial Header -->
    <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(2rem, 4vw, 3.5rem); margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: center; gap: 2rem; flex-wrap: wrap;">
        <div style="max-width: 650px;">
            <span class="text-uppercase text-xs text-clay">Collection</span>
            <h1 style="margin: 0.5rem 0 1rem; font-size: clamp(2.2rem, 4vw, 3.2rem);">{{ $category->name }}</h1>
            @if($category->description)
                <p class="lead-text">{{ $category->description }}</p>
            @endif
        </div>
        <div>
            <span class="badge badge-dark" style="font-size: 0.8125rem; padding: 0.4rem 0.85rem;">{{ $products->total() }} Pieces Available</span>
        </div>
    </div>

    <!-- Products Grid & Controls -->
    <div class="flex justify-between items-center" style="margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <!-- Categories Pill Filter -->
        <div class="flex gap-1" style="flex-wrap: wrap;">
            <a href="{{ route('shop.index') }}" class="btn btn-secondary btn-sm" style="border-radius: var(--radius-full);">All</a>
            @foreach($categories as $c)
                <a href="{{ route('shop.category', $c->slug) }}" 
                   class="btn {{ $c->id === $category->id ? 'btn-dark' : 'btn-secondary' }} btn-sm" 
                   style="border-radius: var(--radius-full);">
                    {{ $c->name }}
                </a>
            @endforeach
        </div>

        <!-- Sorting -->
        <form method="GET" action="{{ route('shop.category', $category->slug) }}">
            <select name="sort" onchange="this.form.submit()" class="form-control" style="width: auto; padding: 0.5rem 1rem; font-size: 0.875rem;">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                <option value="bestseller" {{ $sort === 'bestseller' ? 'selected' : '' }}>Bestsellers</option>
                <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
        </form>
    </div>

    @if($products->isEmpty())
        <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 4rem 2rem; border-radius: var(--radius-sm); text-align: center;">
            <h3 style="margin-bottom: 0.5rem;">Collection Updating</h3>
            <p class="text-muted" style="margin-bottom: 1.5rem;">New handcrafted pieces from this collection are currently firing in our kilns.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-secondary">Explore Other Collections</a>
        </div>
    @else
        <div class="product-grid">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div style="margin-top: 3.5rem; display: flex; justify-content: center;">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection

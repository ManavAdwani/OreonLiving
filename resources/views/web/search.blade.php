@extends('layouts.app')

@section('title', 'Search Earthen Pieces | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Search Bar -->
    <div style="max-width: 680px; margin: 0 auto 3.5rem; text-align: center;">
        <span class="text-uppercase text-xs text-clay">Discovery</span>
        <h1 style="margin: 0.5rem 0 1.5rem; font-size: clamp(2.2rem, 4vw, 3rem);">Search Our Kiln Collections</h1>
        
        <form method="GET" action="{{ route('search') }}" style="display: flex; gap: 0.5rem; background: var(--color-surface); padding: 0.5rem; border: 1.5px solid var(--color-border); border-radius: var(--radius-sm); box-shadow: var(--shadow-subtle);">
            <input type="text" name="q" value="{{ $query }}" placeholder="Search by name, clay type, carafe, planter, handi, or SKU..." required style="flex: 1; padding: 0.75rem 1rem; font-size: 1rem;">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Suggested Queries / Categories -->
        <div class="flex justify-center gap-1" style="margin-top: 1.25rem; flex-wrap: wrap;">
            <span style="font-size: 0.8125rem; color: var(--color-text-muted);">Popular:</span>
            <a href="{{ route('search', ['q' => 'Water Carafe']) }}" class="badge badge-clay" style="text-transform: none;">Water Carafe</a>
            <a href="{{ route('search', ['q' => 'Curd Handi']) }}" class="badge badge-clay" style="text-transform: none;">Curd Handi</a>
            <a href="{{ route('search', ['q' => 'Pedestal Planter']) }}" class="badge badge-clay" style="text-transform: none;">Pedestal Planter</a>
            <a href="{{ route('search', ['q' => 'Kulhad']) }}" class="badge badge-clay" style="text-transform: none;">Kulhad</a>
        </div>
    </div>

    @if($query !== '')
        <div style="margin-bottom: 2rem;">
            <h2>Results for &ldquo;{{ $query }}&rdquo;</h2>
            <p class="text-muted">{{ $products->total() }} pieces found in our collection</p>
        </div>

        @if($products->isEmpty())
            <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 4rem 2rem; text-align: center; margin-bottom: 4rem;">
                <h3 style="margin-bottom: 0.5rem;">No matching earthen pieces found</h3>
                <p class="text-muted" style="margin-bottom: 1.5rem; max-width: 480px; margin-left: auto; margin-right: auto;">
                    We couldn't find any piece matching "{{ $query }}". Please check spelling or explore our popular categories below.
                </p>
                <a href="{{ route('shop.index') }}" class="btn btn-dark">Browse All Earthen Pieces</a>
            </div>
        @else
            <div class="product-grid" style="margin-bottom: 3.5rem;">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div style="display: flex; justify-content: center; margin-bottom: 4rem;">
                {{ $products->links() }}
            </div>
        @endif
    @endif

    <!-- Suggested Categories Grid -->
    <div style="border-top: 1px solid var(--color-border); padding-top: 3.5rem;">
        <h3 style="font-size: 1.5rem; margin-bottom: 1.75rem;">Explore by Category</h3>
        <div class="category-grid">
            @foreach($suggestedCategories as $cat)
                <a href="{{ route('shop.category', $cat->slug) }}" class="category-card" style="aspect-ratio: 16/9;">
                    <img src="{{ $cat->image ?: 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $cat->name }}" loading="lazy">
                    <div class="category-card-content">
                        <h4 class="category-card-title" style="font-size: 1.4rem;">{{ $cat->name }}</h4>
                        <span class="category-card-link">Explore Collection &rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

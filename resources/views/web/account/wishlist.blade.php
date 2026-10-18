@extends('layouts.app')

@section('title', 'Saved Pieces (Wishlist) | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('account.dashboard') }}">My Account</a>
        <span class="breadcrumb-separator">/</span>
        <span>Wishlist</span>
    </nav>

    <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.25rem;">Saved Earthen Pieces</h1>
            <p class="text-muted">Your curated sanctuary of pieces waiting for your living spaces.</p>
        </div>
        <span class="badge badge-dark">{{ $wishlists->count() }} Pieces Saved</span>
    </div>

    @if($wishlists->isEmpty())
        <div style="background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 5rem 2rem; text-align: center; max-width: 600px; margin: 0 auto 4rem;">
            <div style="width: 64px; height: 64px; border-radius: var(--radius-full); background: var(--color-surface-subtle); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: var(--color-clay);">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </div>
            <h3 style="margin-bottom: 0.5rem;">Your Wishlist is Empty</h3>
            <p class="text-muted" style="margin-bottom: 2rem;">Save pieces as you browse to keep track of your favorite pottery and terracotta creations.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg">Explore All Pieces</a>
        </div>
    @else
        <div class="product-grid" style="margin-bottom: 4rem;">
            @foreach($wishlists as $wish)
                @if($wish->product)
                    <x-product-card :product="$wish->product" />
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection

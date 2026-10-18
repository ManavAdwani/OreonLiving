@extends('layouts.app')

@section('title', 'My Account | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <span>My Account</span>
    </nav>

    <div style="display: grid; grid-template-columns: 240px 1fr; gap: 3rem; align-items: start;" class="account-layout">
        <!-- Sidebar Navigation -->
        <aside style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 1.5rem;">
            <div style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--color-border-subtle); padding-bottom: 1rem;">
                <h4 style="font-size: 1.125rem; font-weight: 600;">{{ $user->name }}</h4>
                <span style="font-size: 0.75rem; color: var(--color-text-muted);">{{ $user->email }}</span>
            </div>

            <nav style="display: flex; flex-direction: column; gap: 0.35rem;">
                <a href="{{ route('account.dashboard') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; font-weight: 600; background: var(--color-clay-light); color: var(--color-clay);">
                    Dashboard Overview
                </a>
                <a href="{{ route('account.orders') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-text);">
                    Order History
                </a>
                <a href="{{ route('account.addresses') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-text);">
                    Saved Addresses
                </a>
                <a href="{{ route('wishlist.index') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-text);">
                    Saved Pieces (Wishlist)
                </a>
                
                @if($user->isStaff())
                    <a href="{{ route('admin.dashboard') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-clay); font-weight: 600; border: 1px dashed var(--color-clay); margin-top: 0.5rem;">
                        Staff Admin Portal &rarr;
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST" style="margin-top: 1rem; border-top: 1px solid var(--color-border-subtle); padding-top: 0.75rem;">
                    @csrf
                    <button type="submit" style="width: 100%; text-align: left; padding: 0.5rem 0.85rem; font-size: 0.875rem; color: var(--color-danger); font-weight: 500;">
                        Sign Out
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Account Content -->
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Account Overview</h1>
            <p class="text-muted" style="margin-bottom: 2rem;">Manage your earthen orders, deliveries, and saved shipping preferences.</p>

            <!-- Metrics Cards -->
            <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
                <div style="background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 1.5rem;">
                    <span style="font-size: 0.8125rem; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Total Orders Placed</span>
                    <span style="display: block; font-size: 2rem; font-weight: 700; color: var(--color-text); margin-top: 0.5rem;">{{ $ordersCount }}</span>
                </div>

                <div style="background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 1.5rem;">
                    <span style="font-size: 0.8125rem; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Saved in Wishlist</span>
                    <span style="display: block; font-size: 2rem; font-weight: 700; color: var(--color-text); margin-top: 0.5rem;">{{ $wishlistCount }}</span>
                </div>
            </div>

            <!-- Recent Orders -->
            <div style="background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 1.125rem; font-weight: 600;">Recent Orders</h3>
                    <a href="{{ route('account.orders') }}" style="font-size: 0.8125rem; color: var(--color-clay); font-weight: 600;">View All Orders &rarr;</a>
                </div>

                @if($recentOrders->isEmpty())
                    <div style="padding: 3rem 1.5rem; text-align: center;">
                        <p class="text-muted" style="margin-bottom: 1rem;">You have not placed any orders yet.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-secondary btn-sm">Explore Collection</a>
                    </div>
                @else
                    <div style="padding: 0 1.5rem;">
                        @foreach($recentOrders as $ord)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.25rem 0; border-bottom: 1px solid var(--color-border-subtle); flex-wrap: wrap; gap: 1rem;">
                                <div>
                                    <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 0.2rem;">Order #{{ $ord->order_number }}</h4>
                                    <span style="font-size: 0.8125rem; color: var(--color-text-muted);">{{ $ord->created_at->format('d M Y') }} &bull; {{ $ord->items()->count() }} items</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="badge {{ $ord->status_badge_class }}">{{ ucfirst($ord->order_status) }}</span>
                                    <span style="font-weight: 700; font-size: 1rem;">₹{{ number_format($ord->total, 2) }}</span>
                                    <a href="{{ route('account.orders.detail', $ord->order_number) }}" class="btn btn-secondary btn-sm">Details</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 860px) {
    .account-layout {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection

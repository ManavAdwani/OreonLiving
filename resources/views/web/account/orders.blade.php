@extends('layouts.app')

@section('title', 'Order History | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('account.dashboard') }}">My Account</a>
        <span class="breadcrumb-separator">/</span>
        <span>Orders</span>
    </nav>

    <div class="account-layout">
        <!-- Sidebar -->
        <aside style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 1.5rem;">
            <nav class="account-sidebar-nav" style="display: flex; flex-direction: column; gap: 0.35rem;">
                <a href="{{ route('account.dashboard') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-text);">
                    Dashboard Overview
                </a>
                <a href="{{ route('account.orders') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; font-weight: 600; background: var(--color-clay-light); color: var(--color-clay);">
                    Order History
                </a>
                <a href="{{ route('account.addresses') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-text);">
                    Saved Addresses
                </a>
                <a href="{{ route('wishlist.index') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-text);">
                    Saved Pieces (Wishlist)
                </a>
            </nav>
        </aside>

        <!-- Orders Table -->
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Your Orders</h1>
            <p class="text-muted" style="margin-bottom: 2rem;">Track shipments, review past orders, and request returns or invoices.</p>

            @if($orders->isEmpty())
                <div style="background: var(--color-surface); border: 1px solid var(--color-border); padding: 4rem 2rem; border-radius: var(--radius-sm); text-align: center;">
                    <h3 style="margin-bottom: 0.5rem;">No Orders Found</h3>
                    <p class="text-muted" style="margin-bottom: 1.5rem;">You haven't placed an order yet.</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-primary">Discover the Collection</a>
                </div>
            @else
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach($orders as $order)
                        <div style="background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--color-border-subtle); padding-bottom: 1rem; margin-bottom: 1rem; flex-wrap: wrap; gap: 0.5rem;">
                                <div>
                                    <span style="font-size: 0.8125rem; color: var(--color-text-muted);">Placed on {{ $order->created_at->format('d M, Y') }}</span>
                                    <h3 style="font-size: 1.15rem; font-weight: 600; margin-top: 0.2rem;">#{{ $order->order_number }}</h3>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="badge {{ $order->status_badge_class }}">{{ ucfirst($order->order_status) }}</span>
                                    <span style="font-weight: 700; font-size: 1.1rem; color: var(--color-text); margin-left: 0.5rem;">₹{{ number_format($order->total, 2) }}</span>
                                </div>
                            </div>

                            <!-- Items Summary -->
                            <div style="margin-bottom: 1.25rem;">
                                @foreach($order->items as $item)
                                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem; padding: 0.35rem 0;">
                                        <span>{{ $item->product_name }} &times; {{ $item->quantity }}</span>
                                        <span style="font-weight: 600;">₹{{ number_format($item->total, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>

                            @if($order->tracking_number)
                                <div style="background: var(--color-surface-subtle); padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-size: 0.8125rem; margin-bottom: 1.25rem;">
                                    <strong>Tracking:</strong> {{ $order->carrier_name ?: 'Express' }} &bull; {{ $order->tracking_number }}
                                    @if($order->tracking_url)
                                        <a href="{{ $order->tracking_url }}" target="_blank" style="color: var(--color-clay); text-decoration: underline; margin-left: 0.5rem;">Live Courier Link &rarr;</a>
                                    @endif
                                </div>
                            @endif

                            <div class="flex justify-between items-center" style="border-top: 1px solid var(--color-border-subtle); padding-top: 1rem; flex-wrap: wrap; gap: 0.5rem;">
                                <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" style="font-size: 0.8125rem; color: var(--color-text-muted); text-decoration: underline;">
                                    Download Tax Invoice
                                </a>
                                <a href="{{ route('account.orders.detail', $order->order_number) }}" class="btn btn-secondary btn-sm">
                                    View Full Details &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 2.5rem; display: flex; justify-content: center;">
                    {{ $orders->links() }}
                </div>
            @endif
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

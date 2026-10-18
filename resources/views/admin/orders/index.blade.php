@extends('layouts.admin')

@section('header_title', 'Order Fulfillment Management')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">All Customer Shipments</h3>
            <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">{{ $orders->total() }} total orders recorded</span>
        </div>
        <div class="flex gap-1">
            @if(auth()->user()->canAccessSection('reports'))
                <a href="{{ route('admin.export.orders') }}" class="btn btn-secondary btn-sm">Export Orders CSV</a>
            @endif
        </div>
    </div>

    <!-- Status Tabs & Filter -->
    <div style="padding: 1rem 1.5rem; background: #F9FAFB; border-bottom: 1px solid var(--admin-border); display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
        <!-- Status Tabs -->
        <div class="flex gap-1" style="flex-wrap: wrap;">
            <a href="{{ route('admin.orders.index') }}" class="btn {{ !request('status') ? 'btn-dark' : 'btn-secondary' }} btn-sm">All</a>
            @foreach($statuses as $st)
                <a href="{{ route('admin.orders.index', ['status' => $st]) }}" 
                   class="btn {{ request('status') === $st ? 'btn-dark' : 'btn-secondary' }} btn-sm">
                    {{ ucfirst(str_replace('_', ' ', $st)) }}
                </a>
            @endforeach
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('admin.orders.index') }}" style="display: flex; gap: 0.5rem; margin-left: auto;">
            @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Order #, Name, Phone..." class="form-control" style="width: 220px; padding: 0.45rem 0.75rem; font-size: 0.8125rem;">
            <button type="submit" class="btn btn-secondary btn-sm">Search</button>
        </form>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Items</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Tracking</th>
                <th style="text-align: right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>
                        <strong style="color: var(--admin-text);">{{ $order->order_number }}</strong>
                        @if($order->utm_source)
                            <span class="badge badge-olive" style="font-size: 0.65rem; margin-top: 2px;">{{ $order->utm_source }}</span>
                        @endif
                    </td>
                    <td>
                        <div>{{ $order->customer_name }}</div>
                        <span style="font-size: 0.75rem; color: var(--admin-text-muted);">{{ $order->customer_phone }}</span>
                    </td>
                    <td>{{ $order->created_at->format('d M, Y') }}</td>
                    <td>{{ $order->items->sum('quantity') }} pcs</td>
                    <td><strong>₹{{ number_format($order->total, 2) }}</strong></td>
                    <td>
                        <span class="badge {{ $order->payment_status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                            {{ strtoupper($order->payment_method) }} &bull; {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>
                    <td>
                        <span class="status-pill status-{{ $order->order_status }}">
                            {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                        </span>
                    </td>
                    <td>
                        @if($order->tracking_number)
                            <span style="font-family: monospace; font-size: 0.8125rem;">{{ $order->tracking_number }}</span>
                        @else
                            <span style="color: var(--admin-text-muted); font-size: 0.75rem;">None</span>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                            Manage &rarr;
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 3rem;">No orders found matching filters.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="padding: 1.5rem; border-top: 1px solid var(--admin-border); display: flex; justify-content: center;">
        {{ $orders->links() }}
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('header_title', 'Operational Overview')

@section('content')
<!-- Low Stock Warning Alert (PDF items 38, 121) -->
@if($lowStockProducts->isNotEmpty())
    <div class="alert alert-warning" style="margin-bottom: 2rem;">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
        <div style="flex: 1;">
            <strong>Inventory Alert:</strong> {{ $lowStockProducts->count() }} earthen pieces have fallen below their minimum artisan workshop stock threshold.
            <div style="margin-top: 0.5rem; display: flex; gap: 0.5rem; flex-wrap: wrap;">
                @foreach($lowStockProducts as $lowP)
                    <a href="{{ route('admin.products.edit', $lowP->id) }}" class="badge badge-warning" style="text-decoration: underline;">
                        {{ $lowP->name }} ({{ $lowP->stock }} left) &rarr;
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif

<!-- KPI Cards Grid (PDF items 35, 50) -->
<div class="kpi-grid">
    <div class="kpi-card">
        <span class="kpi-label">Gross Revenue (INR)</span>
        <span class="kpi-value">₹{{ number_format($totalRevenue, 2) }}</span>
        <span class="kpi-subtext">Across confirmed &amp; fulfilled orders</span>
    </div>

    <div class="kpi-card">
        <span class="kpi-label">Total Orders</span>
        <span class="kpi-value">{{ $ordersCount }}</span>
        <span class="kpi-subtext">{{ $pendingOrders }} pending &bull; {{ $deliveredCount }} delivered</span>
    </div>

    <div class="kpi-card">
        <span class="kpi-label">Average Order Value (AOV)</span>
        <span class="kpi-value">₹{{ number_format($avgOrderValue, 2) }}</span>
        <span class="kpi-subtext">Per paid transaction</span>
    </div>

    <div class="kpi-card">
        <span class="kpi-label">Registered Customers</span>
        <span class="kpi-value">{{ $totalCustomers }}</span>
        <span class="kpi-subtext">Active patron accounts</span>
    </div>
</div>

<!-- 2-Column Content: Recent Orders + Activity Audit Stream -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;" class="dashboard-grid">
    <!-- Left: Recent Orders -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Recent Customer Orders</h3>
            <div class="flex gap-1">
                @if(auth()->user()->canAccessSection('reports'))
                    <a href="{{ route('admin.export.orders') }}" class="btn btn-secondary btn-sm">Export CSV</a>
                @endif
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">All Orders &rarr;</a>
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td>
                            <strong style="color: var(--admin-text);">{{ $order->order_number }}</strong>
                            <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block;">{{ strtoupper($order->payment_method) }}</span>
                        </td>
                        <td>
                            <div>{{ $order->customer_name }}</div>
                            <span style="font-size: 0.75rem; color: var(--admin-text-muted);">{{ $order->customer_phone }}</span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td><strong>₹{{ number_format($order->total, 2) }}</strong></td>
                        <td>
                            <span class="status-pill status-{{ $order->order_status }}">{{ ucfirst(str_replace('_', ' ', $order->order_status)) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm">Fulfill</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem;">No orders placed yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Right: Activity Logs Audit Trail (PDF item 133, 174) -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Staff Activity Audit</h3>
            @if(auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.activity-logs.index') }}" style="font-size: 0.75rem; color: var(--color-clay); text-decoration: underline;">View All</a>
            @endif
        </div>

        <div style="padding: 1rem 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
            @forelse($recentLogs as $log)
                <div style="border-bottom: 1px solid var(--admin-border); padding-bottom: 0.75rem;">
                    <div class="flex justify-between items-baseline" style="margin-bottom: 0.2rem;">
                        <strong style="font-size: 0.8125rem; color: var(--admin-text);">{{ $log->user_name }}</strong>
                        <span style="font-size: 0.6875rem; color: var(--admin-text-muted);">{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                    <p style="font-size: 0.8125rem; color: var(--admin-text-muted); line-height: 1.4;">{{ $log->description }}</p>
                </div>
            @empty
                <p style="font-size: 0.8125rem; color: var(--admin-text-muted); text-align: center;">No activity recorded yet.</p>
            @endforelse
        </div>
    </div>
</div>

<style>
@media (max-width: 1024px) {
    .dashboard-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection

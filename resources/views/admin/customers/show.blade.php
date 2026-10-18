@extends('layouts.admin')

@section('header_title', 'Customer Profile: ' . $customer->name)

@section('content')
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: start;" class="customer-profile-grid">
    <!-- Left: Profile Info -->
    <div class="admin-card" style="padding: 1.5rem;">
        <h3 class="admin-card-title" style="margin-bottom: 1rem;">Customer Overview</h3>
        <p style="font-size: 0.9375rem; margin-bottom: 0.4rem;"><strong>Name:</strong> {{ $customer->name }}</p>
        <p style="font-size: 0.9375rem; margin-bottom: 0.4rem;"><strong>Email:</strong> {{ $customer->email }}</p>
        <p style="font-size: 0.9375rem; margin-bottom: 0.4rem;"><strong>Phone:</strong> {{ $customer->phone ?: 'Not provided' }}</p>
        <p style="font-size: 0.8125rem; color: var(--admin-text-muted); margin-top: 1rem;">Registered on {{ $customer->created_at->format('d M Y, h:i A') }}</p>

        @if($customer->phone)
            <div style="margin-top: 1.5rem;">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $customer->phone) }}" target="_blank" class="btn btn-sm btn-block" style="background-color: #25D366; color: #FFFFFF;">
                    Open WhatsApp Chat
                </a>
            </div>
        @endif

        <h4 style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--admin-text-muted); margin: 2rem 0 0.75rem; font-weight: 600;">
            Saved Addresses ({{ $customer->addresses->count() }})
        </h4>
        @foreach($customer->addresses as $addr)
            <div style="background: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: 4px; padding: 0.85rem; font-size: 0.8125rem; margin-bottom: 0.75rem;">
                @if($addr->is_default) <span class="badge badge-clay" style="margin-bottom: 0.25rem;">Default</span> @endif
                <div><strong>{{ $addr->name }}</strong> ({{ $addr->phone }})</div>
                <div>{{ $addr->formatted_address }}</div>
            </div>
        @endforeach
    </div>

    <!-- Right: Customer Orders History -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Order History ({{ $customer->orders->count() }})</h3>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Pieces</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customer->orders as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>{{ $order->items->sum('quantity') }} items</td>
                        <td><strong>₹{{ number_format($order->total, 2) }}</strong></td>
                        <td>
                            <span class="status-pill status-{{ $order->order_status }}">
                                {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm">Manage</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem;">Customer has not placed any orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
@media (max-width: 900px) {
    .customer-profile-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection

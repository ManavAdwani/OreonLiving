@extends('layouts.admin')

@section('header_title', 'Customer Directory')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Registered Patrons</h3>
            <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">{{ $customers->total() }} customer accounts</span>
        </div>
        <div class="flex gap-1">
            @if(auth()->user()->canAccessSection('reports'))
                <a href="{{ route('admin.export.customers') }}" class="btn btn-secondary btn-sm">Export Customers CSV</a>
            @endif
        </div>
    </div>

    <!-- Search Bar -->
    <div style="padding: 1rem 1.5rem; background: #F9FAFB; border-bottom: 1px solid var(--admin-border);">
        <form method="GET" action="{{ route('admin.customers.index') }}" style="display: flex; gap: 0.5rem; max-width: 400px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or phone..." class="form-control" style="font-size: 0.875rem;">
            <button type="submit" class="btn btn-secondary btn-sm">Search</button>
        </form>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Registered</th>
                <th>Orders</th>
                <th>Total Spent</th>
                <th style="text-align: right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
                <tr>
                    <td>
                        <strong style="color: var(--admin-text);">{{ $customer->name }}</strong>
                    </td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone ?: 'N/A' }}</td>
                    <td>{{ $customer->created_at->format('d M Y') }}</td>
                    <td><span class="badge badge-dark">{{ $customer->orders_count }} orders</span></td>
                    <td><strong>₹{{ number_format($customer->orders_sum_total ?? 0, 2) }}</strong></td>
                    <td style="text-align: right;">
                        <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-secondary btn-sm">
                            View Profile &rarr;
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="padding: 1.5rem; border-top: 1px solid var(--admin-border); display: flex; justify-content: center;">
        {{ $customers->links() }}
    </div>
</div>
@endsection

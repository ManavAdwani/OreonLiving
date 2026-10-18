@extends('layouts.admin')

@section('header_title', 'Discount Coupons &amp; Offers')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Promotional Campaigns</h3>
            <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">Manage discount codes, percentage rates, min spend, and usage caps.</span>
        </div>
        @if(!auth()->user()->isViewer())
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm">&plus; Create Coupon</a>
        @endif
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Discount Type &amp; Value</th>
                <th>Min Spend</th>
                <th>Max Discount</th>
                <th>Usage</th>
                <th>Expiry</th>
                <th>Status</th>
                <th style="text-align: right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coupons as $coupon)
                <tr>
                    <td><strong style="color: var(--color-clay); font-size: 0.9375rem; letter-spacing: 0.05em;">{{ $coupon->code }}</strong></td>
                    <td>
                        {{ $coupon->type === 'percentage' ? $coupon->value . '% OFF' : '₹' . number_format($coupon->value, 2) . ' Flat' }}
                    </td>
                    <td>{{ $coupon->minimum_order > 0 ? '₹' . number_format($coupon->minimum_order, 2) : 'No min' }}</td>
                    <td>{{ $coupon->max_discount ? '₹' . number_format($coupon->max_discount, 2) : 'None' }}</td>
                    <td>{{ $coupon->used_count }} / {{ $coupon->max_uses ?? '&infin;' }}</td>
                    <td>{{ $coupon->expires_at ? $coupon->expires_at->format('d M Y') : 'Never' }}</td>
                    <td>
                        <span class="status-pill status-{{ $coupon->status ? 'delivered' : 'cancelled' }}">
                            {{ $coupon->status ? 'Active' : 'Disabled' }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div class="action-btn-group" style="justify-content: flex-end;">
                            @if(!auth()->user()->isViewer())
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn-icon" title="Edit">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Delete coupon {{ $coupon->code }}?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-icon-danger" title="Delete">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 2rem;">No coupons created yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

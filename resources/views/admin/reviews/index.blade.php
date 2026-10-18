@extends('layouts.admin')

@section('header_title', 'Customer Review Moderation')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Patron Testimonials &amp; Ratings</h3>
            <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">Moderate customer feedback before or after display on public product pages.</span>
        </div>
        <div class="flex gap-1">
            <a href="{{ route('admin.reviews.index') }}" class="btn {{ !request('status') ? 'btn-dark' : 'btn-secondary' }} btn-sm">All</a>
            <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}" class="btn {{ request('status') === 'pending' ? 'btn-dark' : 'btn-secondary' }} btn-sm">Pending</a>
            <a href="{{ route('admin.reviews.index', ['status' => 'approved']) }}" class="btn {{ request('status') === 'approved' ? 'btn-dark' : 'btn-secondary' }} btn-sm">Approved</a>
            <a href="{{ route('admin.reviews.index', ['status' => 'rejected']) }}" class="btn {{ request('status') === 'rejected' ? 'btn-dark' : 'btn-secondary' }} btn-sm">Rejected</a>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Author</th>
                <th>Rating</th>
                <th>Review Content</th>
                <th>Date</th>
                <th>Status</th>
                <th style="text-align: right;">Moderate</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $rev)
                <tr>
                    <td>
                        <strong>{{ $rev->product?->name ?? 'Deleted Piece' }}</strong>
                    </td>
                    <td>{{ $rev->customer_name }}</td>
                    <td>
                        <span style="color: #D97706; font-weight: 700;">{{ $rev->rating }} &#9733;</span>
                    </td>
                    <td style="max-width: 320px;">
                        @if($rev->title)
                            <strong style="font-size: 0.875rem; display: block; margin-bottom: 2px;">{{ $rev->title }}</strong>
                        @endif
                        <span style="font-size: 0.8125rem; color: var(--admin-text-muted); line-height: 1.4;">{{ $rev->body }}</span>
                    </td>
                    <td>{{ $rev->created_at->format('d M Y') }}</td>
                    <td>
                        <span class="status-pill status-{{ $rev->status === 'approved' ? 'delivered' : ($rev->status === 'pending' ? 'pending' : 'cancelled') }}">
                            {{ ucfirst($rev->status) }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div class="action-btn-group" style="justify-content: flex-end;">
                            @if(!auth()->user()->isViewer())
                                @if($rev->status !== 'approved')
                                    <form action="{{ route('admin.reviews.status', $rev->id) }}" method="POST" style="margin:0;">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success); font-weight: 600;">Approve</button>
                                    </form>
                                @endif

                                @if($rev->status !== 'rejected')
                                    <form action="{{ route('admin.reviews.status', $rev->id) }}" method="POST" style="margin:0;">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-warning);">Reject</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.reviews.destroy', $rev->id) }}" method="POST" onsubmit="return confirm('Delete this review permanently?');" style="margin:0;">
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
                    <td colspan="7" style="text-align: center; padding: 2rem;">No reviews found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="padding: 1.5rem; border-top: 1px solid var(--admin-border); display: flex; justify-content: center;">
        {{ $reviews->links() }}
    </div>
</div>
@endsection

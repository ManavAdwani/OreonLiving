@extends('layouts.admin')

@section('header_title', 'Customer Inquiries & WhatsApp Leads')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">All Customer Inquiries</h3>
        <div class="flex gap-1">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-secondary' }}">All</a>
            <a href="{{ route('admin.contacts.index', ['status' => 'new']) }}" class="btn btn-sm {{ request('status') == 'new' ? 'btn-primary' : 'btn-secondary' }}">New</a>
            <a href="{{ route('admin.contacts.index', ['status' => 'in_progress']) }}" class="btn btn-sm {{ request('status') == 'in_progress' ? 'btn-primary' : 'btn-secondary' }}">In Progress</a>
            <a href="{{ route('admin.contacts.index', ['status' => 'resolved']) }}" class="btn btn-sm {{ request('status') == 'resolved' ? 'btn-primary' : 'btn-secondary' }}">Resolved</a>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Contact Info</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $item)
                <tr>
                    <td style="font-size: 0.85rem; color: #666;">{{ $item->created_at->format('d M, Y H:i') }}</td>
                    <td style="font-weight: 600;">{{ $item->name }}</td>
                    <td>
                        <div style="font-size: 0.85rem;">
                            <a href="mailto:{{ $item->email }}" style="color: var(--color-clay);">{{ $item->email }}</a>
                            @if($item->phone)
                                <div style="color: #666;">{{ $item->phone }}</div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 500;">{{ $item->subject }}</div>
                        <div style="font-size: 0.8rem; color: #777;">{{ Str::limit($item->message, 60) }}</div>
                    </td>
                    <td>
                        @if($item->status == 'new')
                            <span class="badge badge-warning">New</span>
                        @elseif($item->status == 'in_progress')
                            <span class="badge badge-info">In Progress</span>
                        @else
                            <span class="badge badge-success">Resolved</span>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        <a href="{{ route('admin.contacts.show', $item) }}" class="btn btn-secondary btn-sm">View & Reply</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: #888;">
                        No customer inquiries found for this filter.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 1.5rem;">
        {{ $submissions->links() }}
    </div>
</div>
@endsection

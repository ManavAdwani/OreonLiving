@extends('layouts.admin')

@section('header_title', 'Staff Activity & Audit Logs')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">System Audit Log</h3>
            <p style="font-size: 0.85rem; color: #888; margin-top: 0.25rem;">
                Immutable trail of staff operations (price changes, stock updates, catalog alterations, role changes).
            </p>
        </div>

        <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="flex gap-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by entity, user or action..." class="form-control" style="width: 260px; font-size: 0.85rem; padding: 0.4rem 0.75rem;">
            <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
            @if(request('search'))
                <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-secondary btn-sm">Reset</a>
            @endif
        </form>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 160px;">Date & Time</th>
                    <th>Staff Operator</th>
                    <th>Action</th>
                    <th>Target Entity</th>
                    <th>Details & Value Modifications</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td style="font-size: 0.82rem; color: #555; white-space: nowrap;">
                        {{ $log->created_at->format('d M, Y') }}<br>
                        <span style="color: #999;">{{ $log->created_at->format('H:i:s') }}</span>
                    </td>
                    <td>
                        <div style="font-weight: 600; font-size: 0.9rem;">{{ $log->user_name ?? ($log->user ? $log->user->name : 'System') }}</div>
                        @if($log->user)
                            <div style="font-size: 0.75rem; color: #888;">{{ ucwords(str_replace('_', ' ', $log->user->role)) }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="badge" style="background: #f0ebe4; color: var(--admin-text); font-family: monospace; font-size: 0.75rem;">
                            {{ $log->action }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 500; font-size: 0.88rem;">{{ $log->entity_name ?? '—' }}</div>
                        <div style="font-size: 0.75rem; color: #888;">{{ $log->entity_type }} #{{ $log->entity_id }}</div>
                    </td>
                    <td style="max-width: 380px;">
                        <div style="font-size: 0.85rem; margin-bottom: 0.25rem;">{{ $log->description }}</div>
                        
                        @if($log->old_values || $log->new_values)
                        <div style="background: #fdfbf7; border: 1px solid var(--admin-border); border-radius: 4px; padding: 0.5rem; font-size: 0.8rem; margin-top: 0.4rem; font-family: monospace;">
                            @if($log->old_values)
                                <div style="color: #b91c1c; margin-bottom: 0.2rem;">
                                    <strong>Old:</strong> 
                                    @foreach($log->old_values as $k => $v)
                                        <span>{{ $k }}: {{ is_array($v) ? json_encode($v) : $v }}@if(!$loop->last), @endif</span>
                                    @endforeach
                                </div>
                            @endif

                            @if($log->new_values)
                                <div style="color: #15803d;">
                                    <strong>New:</strong> 
                                    @foreach($log->new_values as $k => $v)
                                        <span>{{ $k }}: {{ is_array($v) ? json_encode($v) : $v }}@if(!$loop->last), @endif</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @endif
                    </td>
                    <td style="font-size: 0.8rem; color: #888; font-family: monospace;">
                        {{ $log->ip_address ?? '127.0.0.1' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: #888;">
                        No activity records found. Changes to products, pricing, stock, or roles will appear here automatically.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 1.5rem;">
        {{ $logs->links() }}
    </div>
</div>
@endsection

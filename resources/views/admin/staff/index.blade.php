@extends('layouts.admin')

@section('header_title', 'Staff Management & Role-Based Access')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Staff Members & Roles</h3>
            <p style="font-size: 0.85rem; color: #888; margin-top: 0.25rem;">Super Admin privilege: create accounts, toggle active access, and reset passwords.</p>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm">+ Add New Staff</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Staff Name & Email</th>
                    <th>Assigned Role</th>
                    <th>Permissions Scope</th>
                    <th>Status</th>
                    <th>Last Active</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffMembers as $staff)
                <tr>
                    <td>
                        <div style="font-weight: 600;">{{ $staff->name }}</div>
                        <div style="font-size: 0.85rem; color: #666;">{{ $staff->email }}</div>
                        @if($staff->phone)
                            <div style="font-size: 0.8rem; color: #888;">{{ $staff->phone }}</div>
                        @endif
                    </td>
                    <td>
                        @php
                            $roleBadges = [
                                'super_admin' => 'badge-danger',
                                'content_manager' => 'badge-info',
                                'product_manager' => 'badge-warning',
                                'order_manager' => 'badge-success',
                                'customer_support' => 'badge-info',
                                'marketing_manager' => 'badge-warning',
                                'viewer' => 'badge-secondary',
                            ];
                        @endphp
                        <span class="badge {{ $roleBadges[$staff->role] ?? 'badge-secondary' }}">
                            {{ ucwords(str_replace('_', ' ', $staff->role)) }}
                        </span>
                    </td>
                    <td style="font-size: 0.82rem; color: #555; max-width: 250px;">
                        @switch($staff->role)
                            @case('super_admin')
                                Full system access, staff & audit log management
                                @break
                            @case('content_manager')
                                Homepage, hero banners, FAQs, website text
                                @break
                            @case('product_manager')
                                Products, inventory, pricing, categories
                                @break
                            @case('order_manager')
                                Customer orders, shipping status, tracking links
                                @break
                            @case('customer_support')
                                Customer accounts, inquiries, WhatsApp leads
                                @break
                            @case('marketing_manager')
                                Coupons, UTM campaigns, basic reports
                                @break
                            @default
                                Read-only store data inspection
                        @endswitch
                    </td>
                    <td>
                        @if($staff->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Disabled</span>
                        @endif
                    </td>
                    <td style="font-size: 0.85rem; color: #666;">
                        {{ $staff->last_login_at ? $staff->last_login_at->diffForHumans() : 'Never logged in' }}
                    </td>
                    <td style="text-align: right;">
                        <div class="flex gap-1" style="justify-content: flex-end; align-items: center;">
                            @if($staff->id !== auth()->id())
                                <form action="{{ route('admin.staff.toggle', $staff) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $staff->is_active ? 'btn-danger' : 'btn-primary' }}" onclick="return confirm('Change status for this staff account?');">
                                        {{ $staff->is_active ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>

                                <!-- Password reset modal trigger -->
                                <button type="button" class="btn btn-secondary btn-sm" onclick="promptPasswordReset('{{ $staff->id }}', '{{ $staff->name }}')">
                                    Reset Password
                                </button>
                            @else
                                <span style="font-size: 0.8rem; color: #888; font-style: italic;">Current Session</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Password Reset Form Modal / Script -->
<form id="reset-password-form" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="password" id="reset-new-password">
</form>

<script>
function promptPasswordReset(staffId, staffName) {
    const newPass = prompt(`Enter new password for ${staffName} (minimum 8 characters):`);
    if (newPass && newPass.length >= 8) {
        const form = document.getElementById('reset-password-form');
        form.action = `/admin/staff/${staffId}/reset-password`;
        document.getElementById('reset-new-password').value = newPass;
        form.submit();
    } else if (newPass) {
        alert('Password must be at least 8 characters long.');
    }
}
</script>
@endsection

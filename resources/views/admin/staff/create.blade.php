@extends('layouts.admin')

@section('header_title', 'Create Staff Account')

@section('content')
<div style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Add Staff Member</h3>
            <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Staff</a>
        </div>

        <form action="{{ route('admin.staff.store') }}" method="POST" style="padding: 2rem;">
            @csrf

            <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="form-control" placeholder="e.g. Radhika Sharma">
            </div>

            <div class="form-group">
                <label class="form-label">Work Email Address *</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="e.g. radhika@oreonliving.com">
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number (Optional)</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+91 98765 43210">
            </div>

            <div class="form-group">
                <label class="form-label">Role & Access Scope *</label>
                <select name="role" required class="form-control">
                    @foreach($roles as $key => $label)
                        <option value="{{ $key }}" {{ old('role') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <div style="font-size: 0.8rem; color: #888; margin-top: 0.25rem;">
                    Each role only sees and accesses the admin areas permitted by the role-based middleware.
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Temporary Initial Password *</label>
                <input type="password" name="password" required minlength="8" class="form-control" placeholder="Minimum 8 characters">
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Create Staff Account</button>
                <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

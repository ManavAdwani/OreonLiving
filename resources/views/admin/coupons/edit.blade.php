@extends('layouts.admin')

@section('header_title', 'Edit Coupon: ' . $coupon->code)

@section('content')
<div style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Modify Coupon</h3>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Coupons</a>
        </div>

        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST" style="padding: 2rem;">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Coupon Code *</label>
                <input type="text" name="code" value="{{ old('code', $coupon->code) }}" required class="form-control" style="text-transform: uppercase;">
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Discount Type *</label>
                    <select name="type" required class="form-control">
                        <option value="percentage" {{ $coupon->type === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                        <option value="fixed" {{ $coupon->type === 'fixed' ? 'selected' : '' }}>Fixed Amount (₹ INR)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Discount Value *</label>
                    <input type="number" step="0.01" name="value" value="{{ old('value', $coupon->value) }}" required class="form-control">
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Minimum Order Requirement (₹)</label>
                    <input type="number" step="0.01" name="minimum_order" value="{{ old('minimum_order', $coupon->minimum_order) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Max Discount Cap (₹)</label>
                    <input type="number" step="0.01" name="max_discount" value="{{ old('max_discount', $coupon->max_discount) }}" class="form-control">
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Usage Limit (Total uses)</label>
                    <input type="number" name="max_uses" value="{{ old('max_uses', $coupon->max_uses) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Expiration Date</label>
                    <input type="date" name="expires_at" value="{{ old('expires_at', $coupon->expires_at?->format('Y-m-d')) }}" class="form-control">
                </div>
            </div>

            <div class="form-group" style="margin-top: 1rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="status" value="1" {{ old('status', $coupon->status) ? 'checked' : '' }}>
                    <span>Coupon is active</span>
                </label>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Update Coupon</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

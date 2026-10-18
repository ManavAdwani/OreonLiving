@extends('layouts.admin')

@section('header_title', 'Create Discount Coupon')

@section('content')
<div style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">New Coupon Promo</h3>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Coupons</a>
        </div>

        <form action="{{ route('admin.coupons.store') }}" method="POST" style="padding: 2rem;">
            @csrf

            <div class="form-group">
                <label class="form-label">Coupon Code * (e.g. FESTIVE20)</label>
                <input type="text" name="code" value="{{ old('code') }}" required class="form-control" style="text-transform: uppercase;">
                @error('code') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Discount Type *</label>
                    <select name="type" required class="form-control">
                        <option value="percentage">Percentage (%)</option>
                        <option value="fixed">Fixed Amount (₹ INR)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Discount Value *</label>
                    <input type="number" step="0.01" name="value" value="{{ old('value') }}" required class="form-control" placeholder="10 or 250.00">
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Minimum Order Requirement (₹)</label>
                    <input type="number" step="0.01" name="minimum_order" value="{{ old('minimum_order', 0) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Max Discount Cap (₹)</label>
                    <input type="number" step="0.01" name="max_discount" value="{{ old('max_discount') }}" class="form-control" placeholder="Optional for % discounts">
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Usage Limit (Total uses)</label>
                    <input type="number" name="max_uses" value="{{ old('max_uses') }}" class="form-control" placeholder="Unlimited if blank">
                </div>

                <div class="form-group">
                    <label class="form-label">Expiration Date</label>
                    <input type="date" name="expires_at" value="{{ old('expires_at') }}" class="form-control">
                </div>
            </div>

            <div class="form-group" style="margin-top: 1rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="status" value="1" checked>
                    <span>Coupon is active immediately</span>
                </label>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Create Coupon</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

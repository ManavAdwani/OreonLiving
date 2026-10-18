@extends('layouts.admin')

@section('header_title', 'Create FAQ')

@section('content')
<div style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Add New FAQ</h3>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary btn-sm">&larr; Back to FAQs</a>
        </div>

        <form action="{{ route('admin.faqs.store') }}" method="POST" style="padding: 2rem;">
            @csrf

            <div class="form-group">
                <label class="form-label">Category Group *</label>
                <input type="text" name="category" value="{{ old('category', 'Care & Maintenance') }}" required class="form-control" placeholder="e.g. Care & Maintenance, Shipping, Orders & Payments">
            </div>

            <div class="form-group">
                <label class="form-label">Question *</label>
                <input type="text" name="question" value="{{ old('question') }}" required class="form-control" placeholder="e.g. How do I season an unglazed clay cooking pot before first use?">
            </div>

            <div class="form-group">
                <label class="form-label">Detailed Answer *</label>
                <textarea name="answer" rows="5" required class="form-control" placeholder="Provide step-by-step guidance for the customer...">{{ old('answer') }}</textarea>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Sort Order (Lower appears first)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control">
                </div>

                <div class="form-group" style="display: flex; align-items: center; padding-top: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="status" value="1" checked>
                        <span>Publish immediately</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Save FAQ</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

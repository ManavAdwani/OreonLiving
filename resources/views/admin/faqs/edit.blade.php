@extends('layouts.admin')

@section('header_title', 'Edit FAQ')

@section('content')
<div style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Edit FAQ #{{ $faq->id }}</h3>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary btn-sm">&larr; Back to FAQs</a>
        </div>

        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" style="padding: 2rem;">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Category Group *</label>
                <input type="text" name="category" value="{{ old('category', $faq->category) }}" required class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Question *</label>
                <input type="text" name="question" value="{{ old('question', $faq->question) }}" required class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Detailed Answer *</label>
                <textarea name="answer" rows="5" required class="form-control">{{ old('answer', $faq->answer) }}</textarea>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order) }}" class="form-control">
                </div>

                <div class="form-group" style="display: flex; align-items: center; padding-top: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="status" value="1" {{ old('status', $faq->status) ? 'checked' : '' }}>
                        <span>Publish active on storefront</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Update FAQ</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

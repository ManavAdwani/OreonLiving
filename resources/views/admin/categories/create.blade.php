@extends('layouts.admin')

@section('header_title', 'Create Category')

@section('content')
<div style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">New Category Definition</h3>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Categories</a>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" style="padding: 2rem;">
            @csrf

            <div class="form-group">
                <label class="form-label">Category Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="form-control" placeholder="e.g. Ritual Diyas & Oil Lamps">
            </div>

            <div class="form-group">
                <label class="form-label">URL Slug (Auto-generated if empty)</label>
                <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="e.g. ritual-diyas-oil-lamps">
            </div>

            <div class="form-group">
                <label class="form-label">Parent Category (Optional - for subcategories)</label>
                <select name="parent_id" class="form-control">
                    <option value="">None (Top-Level Category)</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control" placeholder="Brief editorial descriptor of this collection...">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Cover Image</label>
                <input type="file" name="image" accept="image/*" class="form-control" style="padding: 0.5rem;">
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control">
                </div>

                <div class="form-group" style="margin-top: 1.75rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="status" value="1" checked>
                        <span>Active in Store Navigation</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Save Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

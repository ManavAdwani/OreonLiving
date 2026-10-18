@extends('layouts.admin')

@section('header_title', 'Edit Category: ' . $category->name)

@section('content')
<div style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Modify Category</h3>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Categories</a>
        </div>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" style="padding: 2rem;">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">URL Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" required class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Parent Category</label>
                <select name="parent_id" class="form-control">
                    <option value="">None (Top-Level Category)</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Replace Cover Image</label>
                @if($category->image)
                    <div style="margin-bottom: 0.5rem;">
                        <img src="{{ str_starts_with($category->image, 'http') ? $category->image : asset('storage/' . $category->image) }}" alt="Preview" style="width: 80px; height: 80px; border-radius: 4px; object-fit: cover; border: 1px solid var(--admin-border);">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="form-control" style="padding: 0.5rem;">
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" class="form-control">
                </div>

                <div class="form-group" style="margin-top: 1.75rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="status" value="1" {{ old('status', $category->status) ? 'checked' : '' }}>
                        <span>Active in Store Navigation</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

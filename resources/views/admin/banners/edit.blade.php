@extends('layouts.admin')

@section('header_title', 'Edit Homepage Hero Banner')

@section('content')
<div style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Edit Banner #{{ $banner->id }}</h3>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Banners</a>
        </div>

        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" style="padding: 2rem;">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Headline Title *</label>
                <input type="text" name="title" value="{{ old('title', $banner->title) }}" required class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Subtitle Descriptor</label>
                <textarea name="subtitle" rows="2" class="form-control">{{ old('subtitle', $banner->subtitle) }}</textarea>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Badge Tag</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text', $banner->badge_text) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" class="form-control">
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Button Text *</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" required class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Button Target URL *</label>
                    <input type="text" name="button_url" value="{{ old('button_url', $banner->button_url) }}" required class="form-control">
                </div>
            </div>

            @if($banner->image_url)
            <div style="margin-bottom: 1.25rem;">
                <label class="form-label">Current Banner Preview</label>
                <div style="height: 140px; border-radius: 6px; overflow: hidden; background: #eee;">
                    <img src="{{ $banner->image_url }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
            @endif

            <div class="form-group">
                <label class="form-label">Replace Banner Image File</label>
                <input type="file" name="image" accept="image/*" class="form-control" style="padding: 0.5rem;">
            </div>

            <div class="form-group">
                <label class="form-label">Or Image Web URL</label>
                <input type="url" name="image_url" value="{{ old('image_url', $banner->image_url) }}" class="form-control">
            </div>

            <div class="form-group" style="margin-top: 1rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="status" value="1" {{ old('status', $banner->status) ? 'checked' : '' }}>
                    <span>Banner is active and visible on storefront</span>
                </label>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Update Banner</button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

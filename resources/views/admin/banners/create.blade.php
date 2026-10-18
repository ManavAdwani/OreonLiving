@extends('layouts.admin')

@section('header_title', 'Create Homepage Hero Banner')

@section('content')
<div style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">New Homepage Banner</h3>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Banners</a>
        </div>

        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" style="padding: 2rem;">
            @csrf

            <div class="form-group">
                <label class="form-label">Headline Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="form-control" placeholder="e.g. Natural Materials. Thoughtful Design.">
            </div>

            <div class="form-group">
                <label class="form-label">Subtitle Descriptor</label>
                <textarea name="subtitle" rows="2" class="form-control" placeholder="e.g. Porous terracotta carafes, architectural planters, and slow-cooking vessels...">{{ old('subtitle') }}</textarea>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Badge Tag (e.g. Autumn 2026)</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control">
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Button Text *</label>
                    <input type="text" name="button_text" value="{{ old('button_text', 'Explore Collection') }}" required class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Button Target URL *</label>
                    <input type="text" name="button_url" value="{{ old('button_url', '/shop') }}" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Upload Banner Image File</label>
                <input type="file" name="image" accept="image/*" class="form-control" style="padding: 0.5rem;">
            </div>

            <div class="form-group">
                <label class="form-label">Or Image Web URL (High-res Unsplash / CDN)</label>
                <input type="url" name="image_url" value="{{ old('image_url') }}" class="form-control" placeholder="https://images.unsplash.com/...">
            </div>

            <div class="form-group" style="margin-top: 1rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="status" value="1" checked>
                    <span>Banner is active and visible on storefront</span>
                </label>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Publish Banner</button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

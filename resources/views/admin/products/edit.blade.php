@extends('layouts.admin')

@section('header_title', 'Edit Product: ' . $product->name)

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3 class="admin-card-title">Modify &lsquo;{{ $product->name }}&rsquo;</h3>
                <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">SKU: {{ $product->sku }} &bull; Changes will immediately reflect in the public catalog and generate an audit log record.</span>
            </div>
            <div class="flex gap-1">
                <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="btn btn-secondary btn-sm">View Live Page &nearr;</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Products</a>
            </div>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="padding: 2rem;">
            @csrf
            @method('PUT')

            <!-- 1. Identity -->
            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    1. Identity &amp; Categorization
                </h4>

                <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category *</label>
                        <select name="category_id" required class="form-control">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">URL Slug (PDF item 127)</label>
                        <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Stock Keeping Unit (SKU)</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Short Descriptor</label>
                    <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Full Narrative Description</label>
                    <textarea name="description" rows="5" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <!-- 2. Pricing & Stock (PDF item 96, 97) -->
            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    2. Pricing &amp; Workshop Stock
                </h4>

                <div class="grid" style="grid-template-columns: repeat(3, 1fr); gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Selling Price (₹ INR) *</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Compare-at Price (₹ INR)</label>
                        <input type="number" step="0.01" name="compare_price" value="{{ old('compare_price', $product->compare_price) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Cost of Goods (₹ INR)</label>
                        <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" class="form-control">
                    </div>
                </div>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Units in Stock *</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Low Stock Threshold</label>
                        <input type="number" name="low_stock_threshold" value="{{ old('low_stock_threshold', $product->low_stock_threshold) }}" required min="1" class="form-control">
                    </div>
                </div>
            </div>

            <!-- 3. Photo Gallery Manager (PDF item 98, 124) -->
            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    3. Manage Product Photos
                </h4>

                <!-- Existing Photos Grid -->
                @if($product->images->isNotEmpty())
                    <label class="form-label" style="margin-bottom: 0.75rem; display: block;">Existing Photos (Click to remove without a developer):</label>
                    <div class="flex gap-2" style="flex-wrap: wrap; margin-bottom: 1.5rem;">
                        @foreach($product->images as $img)
                            <div style="position: relative; width: 100px; height: 125px; border-radius: var(--radius-sm); overflow: hidden; border: 1.5px solid var(--admin-border);">
                                <img src="{{ $img->url }}" alt="{{ $img->alt_text }}" style="width: 100%; height: 100%; object-fit: cover;">
                                
                                <button type="button" 
                                        onclick="if(confirm('Delete this photo?')) { document.getElementById('deleteImgForm-{{ $img->id }}').submit(); }"
                                        style="position: absolute; top: 4px; right: 4px; background: rgba(220, 38, 38, 0.9); color: #FFF; width: 22px; height: 22px; border-radius: 9999px; display: flex; align-items: center; justify-content: center; font-size: 11px; cursor: pointer;">
                                    &times;
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Upload Additional Photos</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="form-control" style="padding: 0.6rem;">
                </div>
            </div>

            <!-- 4. Specifications -->
            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    4. Materials &amp; Dimensions
                </h4>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Clay Material</label>
                        <input type="text" name="material" value="{{ old('material', $product->material) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Dimensions</label>
                        <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Weight in Grams</label>
                        <input type="number" name="weight_grams" value="{{ old('weight_grams', $product->weight_grams) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Video URL</label>
                        <input type="url" name="video_url" value="{{ old('video_url', $product->video_url) }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Care Instructions</label>
                    <textarea name="care_instructions" rows="2" class="form-control">{{ old('care_instructions', $product->care_instructions) }}</textarea>
                </div>
            </div>

            <!-- 5. Publishing Status & SEO -->
            <div style="margin-bottom: 2rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    5. Status &amp; SEO
                </h4>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control">
                            <option value="published" {{ old('status', $product->status) === 'published' ? 'selected' : '' }}>Published (Live)</option>
                            <option value="draft" {{ old('status', $product->status) === 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                            <option value="archived" {{ old('status', $product->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div style="display: flex; gap: 1.5rem; align-items: center; margin-top: 1.5rem;">
                        <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer;">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }}>
                            <span>Featured on Homepage</span>
                        </label>

                        <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer;">
                            <input type="checkbox" name="bestseller" value="1" {{ old('bestseller', $product->bestseller) ? 'checked' : '' }}>
                            <span>Mark as Bestseller</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">SEO Meta Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $product->seo_title) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">SEO Meta Description</label>
                    <textarea name="seo_description" rows="2" class="form-control">{{ old('seo_description', $product->seo_description) }}</textarea>
                </div>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem;">
                <button type="submit" class="btn btn-primary btn-lg">Save Product Changes</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Hidden image delete forms -->
@foreach($product->images as $img)
    <form id="deleteImgForm-{{ $img->id }}" action="{{ route('admin.products.images.delete', $img->id) }}" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
@endforeach
@endsection

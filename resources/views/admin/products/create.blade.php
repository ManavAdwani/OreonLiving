@extends('layouts.admin')

@section('header_title', 'Create New Product')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3 class="admin-card-title">Add Earthen Piece to Catalog</h3>
                <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">Enter product narrative, workshop dimensions, pricing, and upload high-res photography.</span>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Products</a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" style="padding: 2rem;">
            @csrf

            <!-- 1. Essential Product Info -->
            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    1. Identity &amp; Categorization
                </h4>

                <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="name" id="productName" value="{{ old('name') }}" required class="form-control" placeholder="e.g. Soham Earthen Water Carafe with Cork Lid">
                        @error('name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category *</label>
                        <select name="category_id" required class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">URL Slug (Auto-generated if blank)</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="e.g. soham-earthen-water-carafe">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Stock Keeping Unit (SKU) * (PDF item 117)</label>
                        <div class="flex gap-1">
                            <input type="text" name="sku" id="skuInput" value="{{ old('sku') }}" class="form-control" placeholder="e.g. OL-WTR-001">
                            <button type="button" onclick="generateSku()" class="btn btn-secondary btn-sm" style="white-space: nowrap;">Auto SKU</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Short Descriptor (Card subline)</label>
                    <input type="text" name="short_description" value="{{ old('short_description') }}" class="form-control" placeholder="e.g. Wheel-thrown porous terracotta carafes that naturally cool drinking water">
                </div>

                <div class="form-group">
                    <label class="form-label">Full Product Story &amp; Description</label>
                    <textarea name="description" rows="5" class="form-control" placeholder="Describe the clay provenance, potter craftsmanship, and everyday rituals...">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- 2. Pricing & Inventory -->
            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    2. Pricing &amp; Workshop Stock
                </h4>

                <div class="grid" style="grid-template-columns: repeat(3, 1fr); gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Selling Price (₹ INR) *</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="form-control" placeholder="1499.00">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Compare-at Price (₹ INR)</label>
                        <input type="number" step="0.01" name="compare_price" value="{{ old('compare_price') }}" class="form-control" placeholder="1899.00">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Cost of Goods (₹ INR)</label>
                        <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price') }}" class="form-control" placeholder="520.00">
                    </div>
                </div>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Units in Stock *</label>
                        <input type="number" name="stock" value="{{ old('stock', 25) }}" required min="0" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Low Stock Warning Threshold (PDF item 121)</label>
                        <input type="number" name="low_stock_threshold" value="{{ old('low_stock_threshold', 5) }}" required min="1" class="form-control">
                    </div>
                </div>
            </div>

            <!-- 3. Specifications & Materials -->
            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    3. Materials &amp; Dimensions
                </h4>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Clay Material</label>
                        <input type="text" name="material" value="{{ old('material', '100% Natural Alluvial Terracotta Clay') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Dimensions</label>
                        <input type="text" name="dimensions" value="{{ old('dimensions') }}" class="form-control" placeholder="e.g. 14cm Diameter &times; 24cm Height">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Weight in Grams</label>
                        <input type="number" name="weight_grams" value="{{ old('weight_grams') }}" class="form-control" placeholder="e.g. 1250">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Craft Video URL (YouTube Embed / MP4)</label>
                        <input type="url" name="video_url" value="{{ old('video_url') }}" class="form-control" placeholder="https://www.youtube.com/embed/...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Care &amp; Seasoning Instructions</label>
                    <textarea name="care_instructions" rows="2" class="form-control" placeholder="Rinse with warm water; avoid chemical dish detergents...">{{ old('care_instructions') }}</textarea>
                </div>
            </div>

            <!-- 4. Product Photos Upload (PDF item 63, 124) -->
            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    4. Product Photography
                </h4>
                <div class="form-group">
                    <label class="form-label">Upload High-Resolution Product Images (Select multiple)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="form-control" style="padding: 0.6rem;">
                    <span style="font-size: 0.75rem; color: var(--admin-text-muted); margin-top: 0.35rem; display: block;">
                        Supported formats: JPG, PNG, WebP. First image becomes the primary storefront showcase image.
                    </span>
                </div>
            </div>

            <!-- 5. Status & Visibility -->
            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    5. Publishing &amp; Badges
                </h4>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Publishing Status *</label>
                        <select name="status" class="form-control">
                            <option value="published">Published (Live in catalog)</option>
                            <option value="draft">Draft (Hidden)</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>

                    <div style="display: flex; gap: 1.5rem; align-items: center; margin-top: 1.5rem;">
                        <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer;">
                            <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                            <span>Featured on Homepage</span>
                        </label>

                        <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer;">
                            <input type="checkbox" name="bestseller" value="1" {{ old('bestseller') ? 'checked' : '' }}>
                            <span>Mark as Bestseller</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 6. Search Engine Optimization (SEO) -->
            <div style="margin-bottom: 2rem;">
                <h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1.25rem; font-weight: 600; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.5rem;">
                    6. Search Engine Optimization (SEO)
                </h4>

                <div class="form-group">
                    <label class="form-label">SEO Meta Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title') }}" class="form-control" placeholder="Piece Name | Oreon Living">
                </div>

                <div class="form-group">
                    <label class="form-label">SEO Meta Description</label>
                    <textarea name="seo_description" rows="2" class="form-control" placeholder="Compelling 160-character description for Google search results...">{{ old('seo_description') }}</textarea>
                </div>
            </div>

            <div class="flex gap-2" style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem;">
                <button type="submit" class="btn btn-primary btn-lg">Publish Product Piece</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    function generateSku() {
        const rand = Math.floor(100 + Math.random() * 900);
        const code = 'OL-ART-' + rand;
        document.getElementById('skuInput').value = code;
    }
</script>
@endsection

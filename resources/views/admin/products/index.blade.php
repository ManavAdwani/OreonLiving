@extends('layouts.admin')

@section('header_title', 'Product Catalogue Management')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">All Earthen Pieces</h3>
            <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">{{ $products->total() }} pieces total &bull; Quick inline stock and price editing enabled</span>
        </div>
        <div class="flex gap-1" style="flex-wrap: wrap;">
            @if(auth()->user()->canAccessSection('reports'))
                <a href="{{ route('admin.export.products') }}" class="btn btn-secondary btn-sm">Export Products CSV</a>
            @endif
            @if(!auth()->user()->isViewer())
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">&plus; Add New Product</a>
            @endif
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div style="padding: 1rem 1.5rem; background: #F9FAFB; border-bottom: 1px solid var(--admin-border); display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
        <form method="GET" action="{{ route('admin.products.index') }}" style="display: flex; gap: 0.75rem; flex: 1; flex-wrap: wrap;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or SKU..." class="form-control" style="max-width: 260px; padding: 0.5rem 0.85rem; font-size: 0.875rem;">

            <select name="category_id" class="form-control" style="max-width: 200px; padding: 0.5rem 0.85rem; font-size: 0.875rem;">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="stock_status" class="form-control" style="max-width: 160px; padding: 0.5rem 0.85rem; font-size: 0.875rem;">
                <option value="">All Stock</option>
                <option value="low" {{ request('stock_status') === 'low' ? 'selected' : '' }}>Low Stock (&le;5)</option>
                <option value="out" {{ request('stock_status') === 'out' ? 'selected' : '' }}>Out of Stock (0)</option>
            </select>

            <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
            @if(request()->anyFilled(['search', 'category_id', 'stock_status']))
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm" style="color: var(--color-danger);">Reset</a>
            @endif
        </form>
    </div>

    <!-- Products Table -->
    <div style="overflow-x: auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Piece</th>
                    <th>Category</th>
                    <th>Price (₹) <small>(Inline Edit)</small></th>
                    <th>Stock <small>(Inline Edit)</small></th>
                    <th>Status</th>
                    <th>Badges</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr id="product-row-{{ $product->id }}">
                        <td>
                            <div class="flex items-center gap-2">
                                <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" style="width: 44px; height: 55px; border-radius: 4px; object-fit: cover; border: 1px solid var(--admin-border); flex-shrink: 0;">
                                <div>
                                    <strong style="font-size: 0.9375rem; color: var(--admin-text); display: block;">{{ $product->name }}</strong>
                                    <span style="font-size: 0.75rem; color: var(--admin-text-muted); font-family: monospace;">{{ $product->sku }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $product->category?->name ?? 'Uncategorized' }}</td>
                        
                        <!-- Quick Price Edit (PDF item 96) -->
                        <td>
                            @if(!auth()->user()->isViewer())
                                <div class="flex items-center gap-1">
                                    <span>₹</span>
                                    <input type="number" step="0.01" value="{{ $product->price }}" id="price-{{ $product->id }}" class="quick-input" onchange="quickUpdateProduct({{ $product->id }})">
                                </div>
                            @else
                                ₹{{ number_format($product->price, 2) }}
                            @endif
                        </td>

                        <!-- Quick Stock Edit (PDF item 97) -->
                        <td>
                            @if(!auth()->user()->isViewer())
                                <div class="flex items-center gap-1">
                                    <input type="number" min="0" value="{{ $product->stock }}" id="stock-{{ $product->id }}" class="quick-input" style="width: 70px;" onchange="quickUpdateProduct({{ $product->id }})">
                                    <span id="stock-status-{{ $product->id }}">
                                        @if($product->stock <= 0)
                                            <span class="badge badge-danger">Out</span>
                                        @elseif($product->isLowStock())
                                            <span class="badge badge-warning">Low</span>
                                        @endif
                                    </span>
                                </div>
                            @else
                                {{ $product->stock }}
                            @endif
                        </td>

                        <td>
                            <span class="status-pill status-{{ $product->status === 'published' ? 'delivered' : 'pending' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>

                        <td>
                            <div class="flex gap-1">
                                @if($product->featured) <span class="badge badge-clay">Featured</span> @endif
                                @if($product->bestseller) <span class="badge badge-dark">Bestseller</span> @endif
                            </div>
                        </td>

                        <td style="text-align: right;">
                            <div class="action-btn-group justify-center" style="justify-content: flex-end;">
                                <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="btn-icon" title="View Public Page">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                </a>

                                @if(!auth()->user()->isViewer())
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-icon" title="Edit Product Specs & Photos">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>

                                    <!-- Delete Button with Confirmation Dialog (PDF item 134) -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('CONFIRMATION REQUIRED:\nAre you sure you want to permanently delete \'{{ addslashes($product->name) }}\' and all its associated photos?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-icon-danger" title="Delete Piece">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 3rem;">No products match your search.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="padding: 1.5rem; border-top: 1px solid var(--admin-border); display: flex; justify-content: center;">
        {{ $products->links() }}
    </div>
</div>

<script>
    // Inline Price and Stock Quick Updater with AJAX (PDF items 96 & 97)
    function quickUpdateProduct(productId) {
        const priceInput = document.getElementById(`price-${productId}`);
        const stockInput = document.getElementById(`stock-${productId}`);

        const price = priceInput ? priceInput.value : null;
        const stock = stockInput ? stockInput.value : null;

        fetch(`/admin/products/${productId}/quick-update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ price, stock })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Flash green feedback
                priceInput.style.borderColor = 'var(--color-success)';
                stockInput.style.borderColor = 'var(--color-success)';
                setTimeout(() => {
                    priceInput.style.borderColor = '';
                    stockInput.style.borderColor = '';
                }, 1500);
            }
        })
        .catch(err => {
            alert('Error updating product. Please try again.');
        });
    }
</script>
@endsection

@extends('layouts.admin')

@section('header_title', 'Category Taxonomy Management')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Catalogue Categories</h3>
            <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">Organize your earthen collections, slug routes, and visual covers.</span>
        </div>
        @if(!auth()->user()->isViewer())
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">&plus; Create Category</a>
        @endif
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Slug Route</th>
                <th>Parent</th>
                <th>Products</th>
                <th>Sort Order</th>
                <th>Status</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>
                        <div class="flex items-center gap-2">
                            <img src="{{ $category->image ?: 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=120&q=80' }}" alt="{{ $category->name }}" style="width: 40px; height: 40px; border-radius: 4px; object-fit: cover; border: 1px solid var(--admin-border);">
                            <div>
                                <strong style="color: var(--admin-text);">{{ $category->name }}</strong>
                                <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $category->description }}</span>
                            </div>
                        </div>
                    </td>
                    <td><code>/shop/{{ $category->slug }}</code></td>
                    <td>{{ $category->parent?->name ?? '&mdash;' }}</td>
                    <td>
                        <span class="badge badge-dark">{{ $category->products_count }} pieces</span>
                    </td>
                    <td>{{ $category->sort_order }}</td>
                    <td>
                        <span class="status-pill status-{{ $category->status ? 'delivered' : 'pending' }}">
                            {{ $category->status ? 'Active' : 'Disabled' }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div class="action-btn-group" style="justify-content: flex-end;">
                            <a href="{{ route('shop.category', $category->slug) }}" target="_blank" class="btn-icon" title="View Public Page">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                            </a>
                            @if(!auth()->user()->isViewer())
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-icon" title="Edit">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete category \'{{ addslashes($category->name) }}\'?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-icon-danger" title="Delete">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">No categories created yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

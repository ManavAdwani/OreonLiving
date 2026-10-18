@extends('layouts.admin')

@section('header_title', 'Homepage Banners &amp; Slider')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Homepage Hero Banners</h3>
            <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">Control hero photography, editorial headlines, subtitles, and button links without a developer (PDF item 99).</span>
        </div>
        @if(!auth()->user()->isViewer())
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary btn-sm">&plus; Create Banner</a>
        @endif
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Banner Preview</th>
                <th>Headline &amp; Subtitle</th>
                <th>Badge</th>
                <th>Button Action</th>
                <th>Sort</th>
                <th>Status</th>
                <th style="text-align: right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($banners as $banner)
                <tr>
                    <td>
                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" style="width: 100px; height: 50px; border-radius: 4px; object-fit: cover; border: 1px solid var(--admin-border);">
                    </td>
                    <td style="max-width: 300px;">
                        <strong style="color: var(--admin-text); display: block;">{{ $banner->title }}</strong>
                        <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $banner->subtitle }}</span>
                    </td>
                    <td>
                        @if($banner->badge_text)
                            <span class="badge badge-clay">{{ $banner->badge_text }}</span>
                        @else
                            &mdash;
                        @endif
                    </td>
                    <td>
                        <span style="font-size: 0.8125rem;">{{ $banner->button_text }} &rarr; <code>{{ $banner->button_url }}</code></span>
                    </td>
                    <td>{{ $banner->sort_order }}</td>
                    <td>
                        <span class="status-pill status-{{ $banner->status ? 'delivered' : 'cancelled' }}">
                            {{ $banner->status ? 'Active' : 'Disabled' }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div class="action-btn-group" style="justify-content: flex-end;">
                            @if(!auth()->user()->isViewer())
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn-icon" title="Edit">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this banner?');" style="margin:0;">
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
                    <td colspan="7" style="text-align: center; padding: 2rem;">No banners configured.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

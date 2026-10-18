@extends('layouts.admin')

@section('header_title', 'FAQ Management')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">All Frequently Asked Questions</h3>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm">+ Add New FAQ</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60px;">Order</th>
                    <th>Category</th>
                    <th>Question</th>
                    <th>Answer Snippet</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr>
                    <td><span class="badge" style="background: #f0ebe4; color: var(--admin-text);">#{{ $faq->sort_order }}</span></td>
                    <td><span class="badge badge-warning">{{ $faq->category }}</span></td>
                    <td style="font-weight: 600; max-width: 250px;">{{ $faq->question }}</td>
                    <td style="color: #666; font-size: 0.85rem; max-width: 320px;">{{ Str::limit($faq->answer, 90) }}</td>
                    <td>
                        @if($faq->status)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Hidden</span>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        <div class="flex gap-1" style="justify-content: flex-end;">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Delete this FAQ entry?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: #888;">
                        No FAQs created yet. Click "+ Add New FAQ" to create one.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 1.5rem;">
        {{ $faqs->links() }}
    </div>
</div>
@endsection

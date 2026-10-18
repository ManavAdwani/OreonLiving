<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $query = Review::with(['product', 'user']);

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        $reviews = $query->latest()->paginate(15)->withQueryString();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function updateStatus(Request $request, Review $review): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $review->update(['status' => $validated['status']]);

        AuditLogService::log(
            action: 'review_moderated',
            entityType: 'Review',
            entityId: $review->id,
            entityName: "Review on {$review->product?->name}",
            description: "Review status updated to {$review->status}"
        );

        return back()->with('success', 'Review status updated.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Services\PincodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(string $slug): View
    {
        $product = Product::published()
            ->where('slug', $slug)
            ->with(['images', 'category', 'variants', 'approvedReviews'])
            ->firstOrFail();

        $relatedProducts = Product::published()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['images', 'category', 'approvedReviews'])
            ->take(4)
            ->get();

        return view('web.catalog.show', compact('product', 'relatedProducts'));
    }

    public function checkPincode(Request $request, PincodeService $pincodeService): JsonResponse
    {
        $request->validate([
            'pincode' => 'required|string|max:10',
        ]);

        $result = $pincodeService->check($request->input('pincode'));
        return response()->json($result);
    }

    public function storeReview(Request $request, string $slug): RedirectResponse
    {
        $product = Product::published()->where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:150',
            'body' => 'required|string|min:5|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'customer_name' => $validated['customer_name'],
            'rating' => $validated['rating'],
            'title' => $validated['title'],
            'body' => $validated['body'],
            'status' => 'approved', // auto-approve verified review
        ]);

        return back()->with('success', 'Thank you for sharing your experience with this earthen piece.');
    }
}

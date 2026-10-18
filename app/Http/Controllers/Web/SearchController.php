<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = trim($request->query('q', ''));
        $products = collect();

        if ($query !== '') {
            $products = Product::published()
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('short_description', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhere('material', 'LIKE', "%{$query}%")
                      ->orWhere('sku', 'LIKE', "%{$query}%")
                      ->orWhereHas('category', function ($cq) use ($query) {
                          $cq->where('name', 'LIKE', "%{$query}%");
                      });
                })
                ->with(['images', 'category', 'approvedReviews'])
                ->paginate(12)
                ->withQueryString();
        }

        $suggestedCategories = Category::active()->take(4)->get();
        $popularProducts = Product::bestsellers()->with(['images', 'category'])->take(4)->get();

        return view('web.search', compact('query', 'products', 'suggestedCategories', 'popularProducts'));
    }
}

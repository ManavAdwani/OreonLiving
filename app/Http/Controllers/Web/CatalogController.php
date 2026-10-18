<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::active()->get();
        $query = Product::published()->with(['images', 'category', 'approvedReviews']);

        // Filter by category
        if ($request->filled('category')) {
            $cat = Category::where('slug', $request->query('category'))->first();
            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->query('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->query('max_price'));
        }

        // Filter by in-stock
        if ($request->query('in_stock') === '1') {
            $query->where('stock', '>', 0);
        }

        // Sorting
        $sort = $request->query('sort', 'newest');
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'bestseller' => $query->orderByDesc('bestseller')->latest(),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();
        $selectedCategory = $request->filled('category') 
            ? Category::where('slug', $request->query('category'))->first() 
            : null;

        return view('web.catalog.index', compact(
            'products',
            'categories',
            'selectedCategory',
            'sort'
        ));
    }

    public function category(string $slug, Request $request): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::active()->get();

        $query = Product::published()
            ->where('category_id', $category->id)
            ->with(['images', 'category', 'approvedReviews']);

        // Price filters
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->query('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->query('max_price'));
        }

        if ($request->query('in_stock') === '1') {
            $query->where('stock', '>', 0);
        }

        $sort = $request->query('sort', 'newest');
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'bestseller' => $query->orderByDesc('bestseller')->latest(),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();

        return view('web.catalog.category', compact(
            'category',
            'products',
            'categories',
            'sort'
        ));
    }
}

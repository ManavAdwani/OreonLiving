<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomepageBanner;
use App\Models\Product;
use App\Models\Review;
use App\Models\WebsiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $banners = HomepageBanner::active()->get();
        $categories = Category::active()->take(6)->get();
        
        $featuredProducts = Product::featured()
            ->with(['images', 'category', 'approvedReviews'])
            ->take(8)
            ->get();

        $bestsellers = Product::bestsellers()
            ->with(['images', 'category', 'approvedReviews'])
            ->take(8)
            ->get();

        $testimonials = Review::approved()
            ->with('product')
            ->where('rating', '>=', 4)
            ->latest()
            ->take(4)
            ->get();

        return view('web.home', compact(
            'banners',
            'categories',
            'featuredProducts',
            'bestsellers',
            'testimonials'
        ));
    }
}

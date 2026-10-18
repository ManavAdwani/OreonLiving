<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactSubmission;
use App\Models\Faq;
use App\Models\Product;
use App\Models\WebsiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('web.pages.about');
    }

    public function contact(): View
    {
        $settings = [
            'email' => WebsiteSetting::get('support_email', 'concierge@oreonliving.com'),
            'phone' => WebsiteSetting::get('support_phone', '+91 98765 43210'),
            'address' => WebsiteSetting::get('address', 'Oreon Living Studio, Heritage Crafts District, Bengaluru 560001'),
            'whatsapp' => WebsiteSetting::get('whatsapp_number', '919876543210'),
        ];

        return view('web.pages.contact', compact('settings'));
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|min:10|max:2000',
        ]);

        ContactSubmission::create($validated);

        return back()->with('success', 'Thank you for reaching out. Our team will connect with you within 24 business hours.');
    }

    public function faq(): View
    {
        $faqs = Faq::active()->get()->groupBy('category');
        return view('web.pages.faq', compact('faqs'));
    }

    public function shippingPolicy(): View
    {
        return view('web.pages.shipping-policy');
    }

    public function returnPolicy(): View
    {
        return view('web.pages.return-policy');
    }

    public function privacyPolicy(): View
    {
        return view('web.pages.privacy-policy');
    }

    public function terms(): View
    {
        return view('web.pages.terms');
    }

    public function sitemap(): Response
    {
        $products = Product::published()->select('slug', 'updated_at')->get();
        $categories = Category::active()->select('slug', 'updated_at')->get();

        $content = view('web.pages.sitemap', compact('products', 'categories'))->render();
        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function robots(): Response
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /account/\nDisallow: /checkout/\n\nSitemap: " . url('/sitemap.xml');
        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}

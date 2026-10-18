<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CatalogController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Storefront Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [CatalogController::class, 'index'])->name('shop.index');
Route::get('/shop/{category}', [CatalogController::class, 'category'])->name('shop.category');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/{slug}/review', [ProductController::class, 'storeReview'])->name('product.review');
Route::post('/api/check-pincode', [ProductController::class, 'checkPincode'])->name('api.check-pincode');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Cart Operations
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::post('/coupon', [CartController::class, 'applyCoupon'])->name('coupon');
    Route::post('/coupon/remove', [CartController::class, 'removeCoupon'])->name('coupon.remove');
});

// Checkout Operations
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
});
Route::get('/order/confirmation/{order_number}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');
Route::get('/order/{order_number}/invoice', [CheckoutController::class, 'invoice'])->name('order.invoice');

// Customer Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer Account Portal
Route::prefix('account')->name('account.')->middleware('auth')->group(function () {
    Route::get('/', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
    Route::get('/orders/{order_number}', [AccountController::class, 'orderDetails'])->name('orders.detail');
    Route::post('/orders/{order_number}/cancel', [AccountController::class, 'cancelOrder'])->name('orders.cancel');
    Route::post('/orders/{order_number}/return', [AccountController::class, 'returnOrder'])->name('orders.return');
    Route::get('/addresses', [AccountController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [AccountController::class, 'storeAddress'])->name('addresses.store');
    Route::delete('/addresses/{id}', [AccountController::class, 'deleteAddress'])->name('addresses.delete');
});
Route::get('/wishlist', [AccountController::class, 'wishlist'])->middleware('auth')->name('wishlist.index');
Route::post('/wishlist/toggle/{product}', [AccountController::class, 'toggleWishlist'])->name('wishlist.toggle');

// Informational & Editorial Pages
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('pages.contact.submit');
Route::get('/faq', [PageController::class, 'faq'])->name('pages.faq');
Route::get('/shipping-policy', [PageController::class, 'shippingPolicy'])->name('pages.shipping-policy');
Route::get('/return-policy', [PageController::class, 'returnPolicy'])->name('pages.return-policy');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('pages.privacy-policy');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('pages.terms');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [PageController::class, 'robots'])->name('robots');

/*
|--------------------------------------------------------------------------
| Admin & Staff Routes (Protected with RBAC)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Staff Auth
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Authenticated Staff Areas
    Route::middleware(['auth', 'admin.role'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Products
        Route::middleware('admin.role:products')->group(function () {
            Route::resource('products', AdminProductController::class);
            Route::post('products/{product}/quick-update', [AdminProductController::class, 'quickUpdate'])->name('products.quick-update');
            Route::delete('products/images/{id}', [AdminProductController::class, 'deleteImage'])->name('products.images.delete');
        });

        // Categories
        Route::middleware('admin.role:categories')->group(function () {
            Route::resource('categories', AdminCategoryController::class);
        });

        // Orders
        Route::middleware('admin.role:orders')->group(function () {
            Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
            Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
            Route::post('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
        });

        // Customers
        Route::middleware('admin.role:customers')->group(function () {
            Route::get('customers', [AdminCustomerController::class, 'index'])->name('customers.index');
            Route::get('customers/{customer}', [AdminCustomerController::class, 'show'])->name('customers.show');
        });

        // Coupons
        Route::middleware('admin.role:coupons')->group(function () {
            Route::resource('coupons', AdminCouponController::class);
        });

        // Reviews
        Route::middleware('admin.role:reviews')->group(function () {
            Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
            Route::post('reviews/{review}/status', [AdminReviewController::class, 'updateStatus'])->name('reviews.status');
            Route::delete('reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
        });

        // Content, Banners & FAQs
        Route::middleware('admin.role:content')->group(function () {
            Route::resource('banners', BannerController::class);
            Route::resource('faqs', AdminFaqController::class);
        });

        // Customer Inquiries & WhatsApp Leads
        Route::middleware('admin.role:support')->group(function () {
            Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
            Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
            Route::post('contacts/{contact}/status', [AdminContactController::class, 'updateStatus'])->name('contacts.status');
        });

        // Staff Management (Super Admin)
        Route::middleware('admin.role:staff')->group(function () {
            Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
            Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');
            Route::post('staff', [StaffController::class, 'store'])->name('staff.store');
            Route::post('staff/{staff}/toggle', [StaffController::class, 'toggleStatus'])->name('staff.toggle');
            Route::post('staff/{staff}/reset-password', [StaffController::class, 'resetPassword'])->name('staff.reset-password');
        });

        // Activity Logs (Super Admin)
        Route::middleware('admin.role:activity_logs')->group(function () {
            Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        });

        // CSV Exports
        Route::middleware('admin.role:reports')->group(function () {
            Route::get('export/orders', [ExportController::class, 'orders'])->name('export.orders');
            Route::get('export/products', [ExportController::class, 'products'])->name('export.products');
            Route::get('export/customers', [ExportController::class, 'customers'])->name('export.customers');
        });
    });
});

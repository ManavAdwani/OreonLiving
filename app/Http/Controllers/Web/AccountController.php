<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function dashboard(): View
    {
        $user = Auth::user();
        $recentOrders = $user->orders()->latest()->take(3)->get();
        $ordersCount = $user->orders()->count();
        $wishlistCount = $user->wishlists()->count();

        return view('web.account.dashboard', compact('user', 'recentOrders', 'ordersCount', 'wishlistCount'));
    }

    public function orders(): View
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);
        return view('web.account.orders', compact('orders'));
    }

    public function orderDetails(string $orderNumber): View
    {
        $order = Auth::user()->orders()
            ->where('order_number', $orderNumber)
            ->with(['items.product.images'])
            ->firstOrFail();

        return view('web.account.order-detail', compact('order'));
    }

    public function cancelOrder(Request $request, string $orderNumber): RedirectResponse
    {
        $order = Auth::user()->orders()->where('order_number', $orderNumber)->firstOrFail();

        if (!$order->canBeCancelled()) {
            return back()->with('error', 'This order has already been dispatched and cannot be cancelled online. Please contact concierge support.');
        }

        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $order->update([
            'order_status' => 'cancelled',
            'cancellation_reason' => $validated['reason'],
        ]);

        // Restock inventory
        foreach ($order->items as $item) {
            if ($item->variant_id && $item->variant) {
                $item->variant->increment('stock', $item->quantity);
            } elseif ($item->product_id && $item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        return back()->with('success', 'Order cancellation processed successfully.');
    }

    public function returnOrder(Request $request, string $orderNumber): RedirectResponse
    {
        $order = Auth::user()->orders()->where('order_number', $orderNumber)->firstOrFail();

        if (!$order->canBeReturned()) {
            return back()->with('error', 'Return window (7 days after delivery) has expired or order is not delivered.');
        }

        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $order->update([
            'order_status' => 'return_requested',
            'return_reason' => $validated['reason'],
        ]);

        return back()->with('success', 'Return pickup request submitted. Our team will contact you within 24 hours.');
    }

    public function addresses(): View
    {
        $addresses = Auth::user()->addresses()->latest()->get();
        return view('web.account.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'phone' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:150',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'is_default' => 'nullable|boolean',
        ]);

        $isDefault = $request->boolean('is_default');

        if ($isDefault) {
            Auth::user()->addresses()->update(['is_default' => false]);
        }

        Auth::user()->addresses()->create(array_merge($validated, [
            'is_default' => $isDefault || Auth::user()->addresses()->count() === 0,
        ]));

        return back()->with('success', 'Address added to your address book.');
    }

    public function deleteAddress(int $id): RedirectResponse
    {
        Auth::user()->addresses()->where('id', $id)->delete();
        return back()->with('success', 'Address deleted.');
    }

    public function wishlist(): View
    {
        $wishlists = Auth::user()->wishlists()->with(['product.images', 'product.category'])->get();
        return view('web.account.wishlist', compact('wishlists'));
    }

    public function toggleWishlist(int $productId, Request $request)
    {
        if (!Auth::check()) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'redirect' => route('login'), 'message' => 'Please sign in to save pieces to your wishlist.'], 401);
            }
            return redirect()->route('login')->with('info', 'Please sign in to save pieces to your wishlist.');
        }

        $existing = Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->first();

        if ($existing) {
            $existing->delete();
            $added = false;
            $msg = 'Removed from your wishlist.';
        } else {
            Wishlist::create(['user_id' => Auth::id(), 'product_id' => $productId]);
            $added = true;
            $msg = 'Saved to your wishlist.';
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'added' => $added,
                'message' => $msg,
                'count' => Auth::user()->wishlists()->count(),
            ]);
        }

        return back()->with('success', $msg);
    }
}

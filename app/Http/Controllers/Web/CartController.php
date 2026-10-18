<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    public function index(): View
    {
        $calculations = $this->cartService->getCalculations();
        return view('web.cart.index', $calculations);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'variant_id' => 'nullable|integer|exists:product_variants,id',
            'buy_now' => 'nullable|boolean',
        ]);

        $quantity = $validated['quantity'] ?? 1;
        $variantId = $validated['variant_id'] ?? null;

        $result = $this->cartService->addItem($validated['product_id'], $quantity, $variantId);

        if (!$result['success']) {
            if ($request->wantsJson()) {
                return response()->json($result, 422);
            }
            return back()->with('error', $result['message']);
        }

        // Direct Buy Now redirects straight to checkout
        if ($request->boolean('buy_now')) {
            return redirect()->route('checkout.index');
        }

        if ($request->wantsJson()) {
            $calculations = $this->cartService->getCalculations();
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'items_count' => $calculations['items_count'],
                'subtotal' => $calculations['subtotal'],
            ]);
        }

        return redirect()->route('cart.index')->with('success', $result['message']);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'cart_item_id' => 'required|integer|exists:cart_items,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $result = $this->cartService->updateQuantity($validated['cart_item_id'], $validated['quantity']);

        if (!$result['success']) {
            if ($request->wantsJson()) {
                return response()->json($result, 422);
            }
            return back()->with('error', $result['message']);
        }

        if ($request->wantsJson()) {
            return response()->json(array_merge($result, $this->cartService->getCalculations()));
        }

        return back()->with('success', $result['message']);
    }

    public function remove(int $id, Request $request)
    {
        $this->cartService->removeItem($id);

        if ($request->wantsJson()) {
            return response()->json(array_merge(['success' => true, 'message' => 'Item removed.'], $this->cartService->getCalculations()));
        }

        return back()->with('success', 'Piece removed from your cart.');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string|max:30']);
        $result = $this->cartService->applyCoupon($request->input('code'));

        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }

        return back()->with('success', $result['message']);
    }

    public function removeCoupon()
    {
        $this->cartService->removeCoupon();
        return back()->with('success', 'Coupon code removed.');
    }
}

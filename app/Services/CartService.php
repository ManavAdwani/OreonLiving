<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Get or create the current active cart
     */
    public function getCart(): Cart
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            // If session cart exists, migrate it
            $sessionId = Session::getId();
            $sessionCart = Cart::where('session_id', $sessionId)->whereNull('user_id')->first();
            if ($sessionCart && $sessionCart->id !== $cart->id) {
                $this->mergeCarts($sessionCart, $cart);
            }
            return $cart->load(['items.product.images', 'items.variant']);
        }

        $sessionId = Session::getId();
        $cart = Cart::firstOrCreate(['session_id' => $sessionId]);
        return $cart->load(['items.product.images', 'items.variant']);
    }

    /**
     * Add product to cart with strict stock check
     */
    public function addItem(int $productId, int $quantity = 1, ?int $variantId = null): array
    {
        $product = Product::published()->findOrFail($productId);
        $cart = $this->getCart();

        $maxStock = $product->stock;
        $price = $product->price;

        if ($variantId) {
            $variant = ProductVariant::where('product_id', $productId)->findOrFail($variantId);
            $maxStock = $variant->stock;
            if ($variant->price) {
                $price = $variant->price;
            }
        }

        if ($maxStock <= 0) {
            return ['success' => false, 'message' => 'Sorry, this piece is currently out of stock.'];
        }

        $itemQuery = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId);

        if ($variantId) {
            $itemQuery->where('variant_id', $variantId);
        } else {
            $itemQuery->whereNull('variant_id');
        }

        $cartItem = $itemQuery->first();

        $newQty = ($cartItem ? $cartItem->quantity : 0) + $quantity;

        if ($newQty > $maxStock) {
            return [
                'success' => false,
                'message' => "Only {$maxStock} units currently available in our artisan workshop.",
            ];
        }

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $newQty,
                'price' => $price, // ensure refreshed price
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'variant_id' => $variantId,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        return ['success' => true, 'message' => 'Added to your earthen collection.'];
    }

    /**
     * Update quantity of an item
     */
    public function updateQuantity(int $cartItemId, int $quantity): array
    {
        $cart = $this->getCart();
        $item = CartItem::where('cart_id', $cart->id)->findOrFail($cartItemId);

        if ($quantity <= 0) {
            $item->delete();
            return ['success' => true, 'message' => 'Item removed from your cart.'];
        }

        $maxStock = $item->variant ? $item->variant->stock : $item->product->stock;

        if ($quantity > $maxStock) {
            return [
                'success' => false,
                'message' => "Only {$maxStock} items available in stock.",
            ];
        }

        $item->update(['quantity' => $quantity]);
        return ['success' => true, 'message' => 'Cart updated.'];
    }

    /**
     * Remove item from cart
     */
    public function removeItem(int $cartItemId): bool
    {
        $cart = $this->getCart();
        return (bool) CartItem::where('cart_id', $cart->id)->where('id', $cartItemId)->delete();
    }

    /**
     * Apply coupon
     */
    public function applyCoupon(string $code): array
    {
        $cart = $this->getCart();
        $code = strtoupper(trim($code));

        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon) {
            return ['success' => false, 'message' => 'Invalid promotional coupon code.'];
        }

        $subtotal = $cart->subtotal;
        $validity = $coupon->isValidFor($subtotal);

        if (!$validity['valid']) {
            return ['success' => false, 'message' => $validity['message']];
        }

        $cart->update(['coupon_code' => $code]);

        return ['success' => true, 'message' => "Coupon '{$code}' applied successfully."];
    }

    /**
     * Remove coupon
     */
    public function removeCoupon(): void
    {
        $cart = $this->getCart();
        $cart->update(['coupon_code' => null]);
    }

    /**
     * Clear all items in cart
     */
    public function clearCart(): void
    {
        $cart = $this->getCart();
        $cart->items()->delete();
        $cart->update(['coupon_code' => null]);
    }

    /**
     * Calculate financial summary for cart
     */
    public function getCalculations(): array
    {
        $cart = $this->getCart();
        $items = $cart->items;

        $subtotal = 0.0;
        foreach ($items as $item) {
            $subtotal += ($item->price * $item->quantity);
        }

        $discount = 0.0;
        $coupon = null;
        if ($cart->coupon_code) {
            $coupon = Coupon::where('code', $cart->coupon_code)->first();
            if ($coupon && $coupon->isValidFor($subtotal)['valid']) {
                $discount = $coupon->calculateDiscount($subtotal);
            } else {
                $cart->update(['coupon_code' => null]);
            }
        }

        $freeThreshold = (float) WebsiteSetting::get('free_shipping_threshold', '1999');
        $standardShipping = (float) WebsiteSetting::get('standard_shipping_fee', '149');

        $shipping = ($subtotal >= $freeThreshold || $subtotal == 0) ? 0.0 : $standardShipping;
        
        // 5% GST inclusive / nominal tax display
        $taxableAmount = max(0, $subtotal - $discount);
        $tax = round($taxableAmount * 0.05, 2);

        $total = max(0, $taxableAmount + $shipping);

        return [
            'cart' => $cart,
            'items_count' => $items->sum('quantity'),
            'subtotal' => round($subtotal, 2),
            'discount' => round($discount, 2),
            'coupon' => $coupon,
            'shipping' => round($shipping, 2),
            'free_shipping_threshold' => $freeThreshold,
            'amount_for_free_shipping' => max(0, $freeThreshold - $subtotal),
            'tax' => $tax,
            'total' => round($total, 2),
        ];
    }

    /**
     * Merge guest session cart into user DB cart upon authentication
     */
    public function mergeGuestCartToUser($user): void
    {
        $sessionId = Session::getId();
        $sessionCart = Cart::where('session_id', $sessionId)->whereNull('user_id')->first();
        if (!$sessionCart) {
            return;
        }

        $userCart = Cart::firstOrCreate(['user_id' => $user->id]);
        $this->mergeCarts($sessionCart, $userCart);
    }

    protected function mergeCarts(Cart $source, Cart $target): void
    {
        foreach ($source->items as $srcItem) {
            $existing = CartItem::where('cart_id', $target->id)
                ->where('product_id', $srcItem->product_id)
                ->where('variant_id', $srcItem->variant_id)
                ->first();

            if ($existing) {
                $existing->increment('quantity', $srcItem->quantity);
            } else {
                $srcItem->update(['cart_id' => $target->id]);
            }
        }

        if ($source->coupon_code && !$target->coupon_code) {
            $target->update(['coupon_code' => $source->coupon_code]);
        }

        $source->delete();
    }
}

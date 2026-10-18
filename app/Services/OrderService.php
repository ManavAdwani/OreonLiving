<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\Payment\PaymentGatewayInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    public function __construct(
        protected CartService $cartService,
        protected PaymentGatewayInterface $paymentGateway
    ) {}

    /**
     * Create order from active cart within a database transaction
     */
    public function createOrder(
        array $customerData,
        string $paymentMethod = 'upi',
        ?string $notes = null,
        array $utmData = []
    ): Order {
        $calculations = $this->cartService->getCalculations();
        $cart = $calculations['cart'];

        if ($cart->items->isEmpty()) {
            throw new Exception('Your shopping cart is empty.');
        }

        return DB::transaction(function () use ($cart, $calculations, $customerData, $paymentMethod, $notes, $utmData) {
            // 1. Lock and validate stock for each cart item
            foreach ($cart->items as $item) {
                if ($item->variant_id) {
                    $variant = ProductVariant::lockForUpdate()->findOrFail($item->variant_id);
                    if ($variant->stock < $item->quantity) {
                        throw new Exception("Product variant '{$variant->title}' only has {$variant->stock} units left in stock.");
                    }
                    $variant->decrement('stock', $item->quantity);
                } else {
                    $product = Product::lockForUpdate()->findOrFail($item->product_id);
                    if ($product->stock < $item->quantity) {
                        throw new Exception("Product '{$product->name}' only has {$product->stock} units left in stock.");
                    }
                    $product->decrement('stock', $item->quantity);
                }
            }

            // 2. Generate unique sequential order number: OL-YYYYMMDD-XXXX
            $orderNumber = $this->generateOrderNumber();

            // 3. Create the Order
            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => Auth::id(),
                'customer_name' => $customerData['name'],
                'customer_email' => $customerData['email'],
                'customer_phone' => $customerData['phone'],
                'shipping_address' => [
                    'name' => $customerData['name'],
                    'phone' => $customerData['phone'],
                    'address_line_1' => $customerData['address_line_1'],
                    'address_line_2' => $customerData['address_line_2'] ?? null,
                    'landmark' => $customerData['landmark'] ?? null,
                    'city' => $customerData['city'],
                    'state' => $customerData['state'],
                    'postal_code' => $customerData['postal_code'],
                    'country' => $customerData['country'] ?? 'India',
                ],
                'subtotal' => $calculations['subtotal'],
                'discount' => $calculations['discount'],
                'coupon_code' => $calculations['coupon']?->code,
                'shipping_fee' => $calculations['shipping'],
                'tax' => $calculations['tax'],
                'total' => $calculations['total'],
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentMethod === 'cod' ? 'pending' : 'pending',
                'order_status' => $paymentMethod === 'cod' ? 'confirmed' : 'pending',
                'notes' => $notes,
                'utm_source' => $utmData['utm_source'] ?? session('utm_source'),
                'utm_medium' => $utmData['utm_medium'] ?? session('utm_medium'),
                'utm_campaign' => $utmData['utm_campaign'] ?? session('utm_campaign'),
            ]);

            // 4. Create snapshot Order Items
            foreach ($cart->items as $item) {
                $name = $item->product->name;
                if ($item->variant) {
                    $name .= ' (' . $item->variant->title . ')';
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'product_name' => $name,
                    'sku' => $item->variant?->sku ?? $item->product->sku,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ]);
            }

            // 5. Update coupon usage count if used
            if ($calculations['coupon']) {
                $calculations['coupon']->increment('used_count');
            }

            // 6. Clear active cart
            $this->cartService->clearCart();

            return $order;
        });
    }

    /**
     * Generate format: OL-20261018-8421
     */
    protected function generateOrderNumber(): string
    {
        do {
            $num = 'OL-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (Order::where('order_number', $num)->exists());

        return $num;
    }
}

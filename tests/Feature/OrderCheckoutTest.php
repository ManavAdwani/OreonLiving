<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Tests\TestCase;

class OrderCheckoutTest extends TestCase
{
    public function test_checkout_validation_and_order_creation(): void
    {
        $product = Product::where('status', 'published')->where('stock', '>=', 5)->first();
        if (!$product) {
            $this->markTestSkipped('No product available.');
        }

        $initialStock = $product->stock;
        $customer = \App\Models\User::factory()->create(['role' => 'customer']);
        $this->actingAs($customer);

        // Add to cart first
        $this->post('/cart/add', [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // Submit checkout
        $checkoutData = [
            'name' => 'Aditi Sen',
            'email' => 'aditi.sen@example.com',
            'phone' => '9876543210',
            'address_line_1' => '42 Green Valley Apartments',
            'city' => 'Bengaluru',
            'state' => 'Karnataka',
            'postal_code' => '560001',
            'payment_method' => 'cod',
        ];

        $response = $this->post('/checkout', $checkoutData);
        $response->assertStatus(302);

        // Find the placed order
        $order = Order::where('customer_email', 'aditi.sen@example.com')->latest()->first();
        $this->assertNotNull($order);
        $this->assertStringStartsWith('OL-', $order->order_number);
        $this->assertEquals(1, $order->items()->count());

        // Verify stock decrement
        $product->refresh();
        $this->assertEquals($initialStock - 1, $product->stock);
    }
}

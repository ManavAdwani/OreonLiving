<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogAndCartTest extends TestCase
{
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Oreon Living');
    }

    public function test_shop_catalog_loads(): void
    {
        $response = $this->get('/shop');
        $response->assertStatus(200);
    }

    public function test_product_detail_page_loads_with_earthen_specs(): void
    {
        $product = Product::where('status', 'published')->first();
        if (!$product) {
            $this->markTestSkipped('No products seeded in database.');
        }

        $response = $this->get("/product/{$product->slug}");
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee('Add to Cart');
    }

    public function test_adding_item_to_cart_and_coupon_calculation(): void
    {
        $product = Product::where('status', 'published')->where('stock', '>', 5)->first();
        if (!$product) {
            $this->markTestSkipped('No stocked product available.');
        }

        $customer = \App\Models\User::where('role', 'customer')->first();
        $this->actingAs($customer);

        // Add to cart
        $addResponse = $this->post('/cart/add', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $addResponse->assertRedirect('/cart');

        // View Cart
        $cartResponse = $this->get('/cart');
        $cartResponse->assertStatus(200);
        $cartResponse->assertSee($product->name);

        // Apply discount coupon
        $coupon = Coupon::where('code', 'WELCOME10')->first();
        if ($coupon) {
            $couponResponse = $this->post('/cart/coupon', [
                'code' => 'WELCOME10',
            ]);
            $couponResponse->assertSessionHas('success');
        }
    }
}

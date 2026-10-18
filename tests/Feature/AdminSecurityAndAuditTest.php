<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class AdminSecurityAndAuditTest extends TestCase
{
    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $customer = User::where('role', 'customer')->first();
        if (!$customer) {
            $customer = User::factory()->create(['role' => 'customer']);
        }

        $response = $this->actingAs($customer)->get('/admin');
        // AdminRoleMiddleware redirects non-staff or returns 403
        $this->assertTrue(in_array($response->status(), [302, 403]));
    }

    public function test_super_admin_can_access_admin_dashboard_and_staff_area(): void
    {
        $admin = User::where('role', 'super_admin')->first();
        if (!$admin) {
            $this->markTestSkipped('No super admin found.');
        }

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);

        $staffResponse = $this->actingAs($admin)->get('/admin/staff');
        $staffResponse->assertStatus(200);
    }

    public function test_product_price_and_stock_quick_update_triggers_audit_log(): void
    {
        $admin = User::where('role', 'super_admin')->first();
        $product = Product::first();

        if (!$admin || !$product) {
            $this->markTestSkipped('Missing admin or product.');
        }

        $oldPrice = (float) $product->price;
        $newPrice = $oldPrice + 100;

        $response = $this->actingAs($admin)->post("/admin/products/{$product->id}/quick-update", [
            'price' => $newPrice,
            'stock' => $product->stock,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Check activity log recorded
        $log = ActivityLog::where('entity_id', $product->id)
            ->where('action', 'product_quick_updated')
            ->latest()
            ->first();

        $this->assertNotNull($log);
        $this->assertEquals($admin->id, $log->user_id);
    }
}

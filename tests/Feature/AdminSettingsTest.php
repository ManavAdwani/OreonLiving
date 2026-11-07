<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\WebsiteSetting;
use Tests\TestCase;

class AdminSettingsTest extends TestCase
{
    public function test_guest_cannot_access_settings_page(): void
    {
        $response = $this->get('/admin/settings');
        $this->assertTrue(in_array($response->headers->get('Location'), [url('/login'), url('/admin/login')]));
    }

    public function test_customer_cannot_access_settings_page(): void
    {
        $customer = User::where('role', 'customer')->first();
        if (!$customer) {
            $customer = User::factory()->create(['role' => 'customer']);
        }

        $response = $this->actingAs($customer)->get('/admin/settings');
        $this->assertTrue(in_array($response->status(), [302, 403]));
    }

    public function test_super_admin_can_view_settings_interface(): void
    {
        $admin = User::where('role', 'super_admin')->first();
        if (!$admin) {
            $this->markTestSkipped('No super admin found in database.');
        }

        $response = $this->actingAs($admin)->get('/admin/settings');
        $response->assertStatus(200);
        $response->assertSee('Website Content &amp; Settings', false);
        $response->assertSee('Sticky Announcement Bar');
        $response->assertSee('Studio Concierge');
    }

    public function test_content_manager_can_view_settings_interface(): void
    {
        $contentManager = User::where('role', 'content_manager')->first();
        if (!$contentManager) {
            $this->markTestSkipped('No content manager found in database.');
        }

        $response = $this->actingAs($contentManager)->get('/admin/settings');
        $response->assertStatus(200);
    }

    public function test_super_admin_can_update_website_settings_and_logs_audit_trail(): void
    {
        $admin = User::where('role', 'super_admin')->first();
        if (!$admin) {
            $this->markTestSkipped('No super admin found in database.');
        }

        $testText = 'Test Announcement ' . rand(1000, 9999);

        $response = $this->actingAs($admin)->post('/admin/settings', [
            'site_name' => 'Oreon Living',
            'site_tagline' => 'Crafted from Earth. Designed for Modern Living.',
            'announcement_bar_enabled' => '1',
            'announcement_bar_text' => $testText,
            'announcement_bar_link' => '/shop',
            'whatsapp_number' => '919876543210',
            'support_phone' => '+91 98765 43210',
            'support_email' => 'concierge@oreonliving.com',
            'address' => '42 Pottery Lane, Heritage Crafts District, Bengaluru',
            'free_shipping_threshold' => '1999',
            'standard_shipping_fee' => '149',
            'instagram_url' => 'https://instagram.com/oreonliving',
            'facebook_url' => 'https://facebook.com/oreonliving',
            'meta_title_default' => 'Oreon Living | Natural Earthen Clay',
            'meta_description_default' => 'Pure unglazed porous pottery and terracotta wares.',
            'meta_pixel_id' => '1234567890',
            'google_analytics_id' => 'G-TEST12345',
            'google_search_console_tag' => 'test-verification-code',
        ]);

        $response->assertRedirect('/admin/settings');
        $response->assertSessionHas('success');

        // Verify setting was updated
        $this->assertEquals($testText, WebsiteSetting::get('announcement_bar_text'));
        $this->assertEquals('test-verification-code', WebsiteSetting::get('google_search_console_tag'));

        // Verify audit log was recorded
        $log = ActivityLog::where('action', 'settings_updated')->latest()->first();
        $this->assertNotNull($log);
        $this->assertEquals($admin->id, $log->user_id);
    }
}

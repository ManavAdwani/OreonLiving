<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display the website settings management interface.
     */
    public function index(): View
    {
        $settings = WebsiteSetting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update website settings across all domains.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // 1. General Branding
            'site_name' => 'required|string|max:120',
            'site_tagline' => 'nullable|string|max:255',

            // 2. Announcement Bar
            'announcement_bar_enabled' => 'nullable|boolean',
            'announcement_bar_text' => 'nullable|string|max:300',
            'announcement_bar_link' => 'nullable|string|max:255',

            // 3. Studio Concierge & Contact Details
            'whatsapp_number' => 'required|string|max:25',
            'support_phone' => 'nullable|string|max:25',
            'support_email' => 'required|email|max:150',
            'address' => 'nullable|string|max:350',

            // 4. Logistics & Shipping Thresholds
            'free_shipping_threshold' => 'required|numeric|min:0',
            'standard_shipping_fee' => 'required|numeric|min:0',

            // 5. Social Presence
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'pinterest_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',

            // 6. Search Engine Optimization (SEO Defaults)
            'meta_title_default' => 'nullable|string|max:150',
            'meta_description_default' => 'nullable|string|max:350',
            'meta_keywords_default' => 'nullable|string|max:255',

            // 7. Tracking & Pixels
            'meta_pixel_id' => 'nullable|string|max:60',
            'google_analytics_id' => 'nullable|string|max:60',
            'google_search_console_tag' => 'nullable|string|max:255',
        ]);

        $groups = [
            'site_name' => 'general',
            'site_tagline' => 'general',
            'announcement_bar_enabled' => 'announcement',
            'announcement_bar_text' => 'announcement',
            'announcement_bar_link' => 'announcement',
            'whatsapp_number' => 'contact',
            'support_phone' => 'contact',
            'support_email' => 'contact',
            'address' => 'contact',
            'free_shipping_threshold' => 'shipping',
            'standard_shipping_fee' => 'shipping',
            'instagram_url' => 'social',
            'facebook_url' => 'social',
            'pinterest_url' => 'social',
            'youtube_url' => 'social',
            'meta_title_default' => 'seo',
            'meta_description_default' => 'seo',
            'meta_keywords_default' => 'seo',
            'meta_pixel_id' => 'tracking',
            'google_analytics_id' => 'tracking',
            'google_search_console_tag' => 'tracking',
        ];

        // Explicit boolean toggle for announcement bar
        $validated['announcement_bar_enabled'] = $request->boolean('announcement_bar_enabled') ? '1' : '0';

        $oldValues = [];
        $newValues = [];

        foreach ($validated as $key => $val) {
            $currentVal = WebsiteSetting::get($key);
            if ($currentVal != $val) {
                $oldValues[$key] = $currentVal;
                $newValues[$key] = $val;
            }
            WebsiteSetting::set($key, $val, $groups[$key] ?? 'general');
        }

        // Audit Trail Logging
        if (!empty($newValues)) {
            $changedKeys = implode(', ', array_keys($newValues));
            AuditLogService::log(
                action: 'settings_updated',
                entityType: 'WebsiteSetting',
                entityId: null,
                entityName: 'Website Configuration',
                description: "Staff updated site settings: {$changedKeys}",
                oldValues: $oldValues,
                newValues: $newValues
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Website settings and content configurations have been updated successfully.');
    }
}


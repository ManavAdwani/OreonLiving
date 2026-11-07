@extends('layouts.admin')

@section('title', 'Website Content & Store Settings')

@section('content')
<div class="admin-page-header">
    <div>
        <span class="text-uppercase text-xs" style="color: var(--color-clay); font-weight: 600; letter-spacing: 0.08em;">Studio Configuration</span>
        <h1 style="font-size: 1.85rem; margin-top: 0.25rem;">Website Content &amp; Settings</h1>
        <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-top: 0.25rem;">
            Manage announcements, concierge contact info, shipping rules, SEO defaults, and tracking tags without touching code.
        </p>
    </div>
    <div>
        <button type="submit" form="settingsForm" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span>Save All Settings</span>
        </button>
    </div>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" id="settingsForm">
    @csrf

    <!-- Settings Navigation Tabs -->
    <div class="settings-tabs-nav" style="display: flex; gap: 0.5rem; border-bottom: 2px solid var(--color-border); margin-bottom: 2rem; overflow-x: auto; padding-bottom: 2px;">
        <button type="button" class="settings-tab-btn active" onclick="switchTab('general', this)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            <span>General &amp; Announcement</span>
        </button>
        <button type="button" class="settings-tab-btn" onclick="switchTab('contact', this)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            <span>Concierge &amp; Studio</span>
        </button>
        <button type="button" class="settings-tab-btn" onclick="switchTab('shipping', this)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            <span>Shipping &amp; Rates</span>
        </button>
        <button type="button" class="settings-tab-btn" onclick="switchTab('social', this)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
            <span>Social Presence</span>
        </button>
        <button type="button" class="settings-tab-btn" onclick="switchTab('seo', this)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <span>SEO Defaults</span>
        </button>
        <button type="button" class="settings-tab-btn" onclick="switchTab('tracking', this)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
            <span>Analytics &amp; Tracking</span>
        </button>
    </div>

    <!-- TAB 1: General & Announcement Bar -->
    <div id="tab-general" class="settings-tab-pane active">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 1.5rem;">
            <!-- Brand Identity Card -->
            <div class="card" style="padding: 1.75rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="color: var(--color-clay);">&#9670;</span> Brand Identity
                </h3>
                <p style="font-size: 0.8125rem; color: var(--color-text-muted); margin-bottom: 1.5rem;">
                    Core storefront brand name and positioning tagline displayed across headers, invoices, and structured data.
                </p>

                <div class="form-group">
                    <label class="form-label">Brand Name *</label>
                    <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings['site_name'] ?? 'Oreon Living') }}" required placeholder="e.g. Oreon Living">
                    @error('site_name') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Brand Tagline</label>
                    <input type="text" name="site_tagline" class="form-control" value="{{ old('site_tagline', $settings['site_tagline'] ?? 'Crafted from Earth. Designed for Modern Living.') }}" placeholder="e.g. Crafted from Earth. Designed for Modern Living.">
                    @error('site_tagline') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Sticky Announcement Bar Card (Item 100) -->
            <div class="card" style="padding: 1.75rem;">
                <div class="flex justify-between items-center" style="margin-bottom: 0.5rem;">
                    <h3 style="font-size: 1.15rem; display: flex; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--color-clay);">&#9670;</span> Sticky Announcement Bar
                    </h3>
                    <span class="badge badge-clay">Storefront Header</span>
                </div>
                <p style="font-size: 0.8125rem; color: var(--color-text-muted); margin-bottom: 1.5rem;">
                    Promotional header ribbon for pan-India shipping notices, festive offers, or kiln updates.
                </p>

                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.65rem; font-weight: 600; font-size: 0.875rem; cursor: pointer;">
                        <input type="checkbox" name="announcement_bar_enabled" value="1" {{ old('announcement_bar_enabled', $settings['announcement_bar_enabled'] ?? '1') == '1' ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: var(--color-clay);">
                        <span>Enable Announcement Bar on Storefront</span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">Announcement Text</label>
                    <textarea name="announcement_bar_text" rows="2" class="form-control" placeholder="e.g. Complimentary pan-India delivery on orders above ₹1,999 • 100% Breakage-Free Guarantee">{{ old('announcement_bar_text', $settings['announcement_bar_text'] ?? '') }}</textarea>
                    <span style="font-size: 0.75rem; color: var(--color-text-muted);">Keep text brief and impactful for mobile screens.</span>
                    @error('announcement_bar_text') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Target Link (Optional)</label>
                    <input type="text" name="announcement_bar_link" class="form-control" value="{{ old('announcement_bar_link', $settings['announcement_bar_link'] ?? '/shop') }}" placeholder="e.g. /shop or https://...">
                    @error('announcement_bar_link') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: Studio Concierge & Contact Details -->
    <div id="tab-contact" class="settings-tab-pane">
        <div class="card" style="padding: 2rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <span style="color: var(--color-clay);">&#9670;</span> Studio Concierge &amp; Customer Support
            </h3>
            <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 2rem;">
                All customer inquiries, WhatsApp concierge buttons, and contact page details sync from these values.
            </p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">
                        <span style="color: #25D366; font-weight: 700;">WhatsApp</span> Concierge Number *
                    </label>
                    <div style="position: relative;">
                        <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '919876543210') }}" required placeholder="e.g. 919876543210 (Country code + 10 digits)">
                    </div>
                    <span style="font-size: 0.75rem; color: var(--color-text-muted);">
                        Used for floating button, PDP piece inquiries, and order confirmation links. Enter numbers only (e.g. 919876543210).
                    </span>
                    @error('whatsapp_number') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Support Telephone</label>
                    <input type="text" name="support_phone" class="form-control" value="{{ old('support_phone', $settings['support_phone'] ?? '+91 98765 43210') }}" placeholder="e.g. +91 98765 43210">
                    <span style="font-size: 0.75rem; color: var(--color-text-muted);">Displayed on Contact page and customer invoice headers.</span>
                    @error('support_phone') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Official Support Email *</label>
                    <input type="email" name="support_email" class="form-control" value="{{ old('support_email', $settings['support_email'] ?? 'concierge@oreonliving.com') }}" required placeholder="e.g. concierge@oreonliving.com">
                    @error('support_email') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Studio &amp; Workshop Physical Address</label>
                <textarea name="address" rows="3" class="form-control" placeholder="e.g. Oreon Living Studio, 42 Pottery Lane, Heritage Crafts District, Bengaluru 560001, Karnataka">{{ old('address', $settings['address'] ?? '') }}</textarea>
                <span style="font-size: 0.75rem; color: var(--color-text-muted);">Rendered on Contact Us page, Tax Invoices, and Schema.org Store Structured Data.</span>
                @error('address') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- TAB 3: Shipping & Logistics Thresholds (Item 139) -->
    <div id="tab-shipping" class="settings-tab-pane">
        <div class="card" style="padding: 2rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <span style="color: var(--color-clay);">&#9670;</span> Pan-India Logistics &amp; Shipping Charges
            </h3>
            <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 2rem;">
                Configure the free delivery threshold and standard courier delivery fee applied automatically during checkout calculations.
            </p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Free Shipping Minimum Cart Value (₹) *</label>
                    <div style="display: flex; align-items: center;">
                        <span style="padding: 0.65rem 1rem; background: var(--color-surface-subtle); border: 1px solid var(--color-border); border-right: none; border-radius: var(--radius-sm) 0 0 var(--radius-sm); font-weight: 600;">₹</span>
                        <input type="number" step="1" min="0" name="free_shipping_threshold" class="form-control" style="border-radius: 0 var(--radius-sm) var(--radius-sm) 0;" value="{{ old('free_shipping_threshold', $settings['free_shipping_threshold'] ?? '1999') }}" required>
                    </div>
                    <span style="font-size: 0.75rem; color: var(--color-text-muted);">Orders at or above this subtotal qualify for complimentary Pan-India shipping.</span>
                    @error('free_shipping_threshold') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Standard Pan-India Shipping Fee (₹) *</label>
                    <div style="display: flex; align-items: center;">
                        <span style="padding: 0.65rem 1rem; background: var(--color-surface-subtle); border: 1px solid var(--color-border); border-right: none; border-radius: var(--radius-sm) 0 0 var(--radius-sm); font-weight: 600;">₹</span>
                        <input type="number" step="1" min="0" name="standard_shipping_fee" class="form-control" style="border-radius: 0 var(--radius-sm) var(--radius-sm) 0;" value="{{ old('standard_shipping_fee', $settings['standard_shipping_fee'] ?? '149') }}" required>
                    </div>
                    <span style="font-size: 0.75rem; color: var(--color-text-muted);">Applied when the customer's subtotal is below the free shipping threshold.</span>
                    @error('standard_shipping_fee') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-top: 1.5rem; background: var(--color-surface-subtle); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border);">
                <div style="display: flex; gap: 0.75rem;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--color-clay); flex-shrink: 0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <div style="font-size: 0.8125rem; color: var(--color-text-muted); line-height: 1.6;">
                        <strong>Live Calculation Logic:</strong> Cart subtotal is checked live. When a patron adds items, the progress bar displays how much is needed to reach complimentary shipping (e.g. <em>"Add ₹350 more for Free Delivery"</em>).
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 4: Social Channels (Item 79) -->
    <div id="tab-social" class="settings-tab-pane">
        <div class="card" style="padding: 2rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <span style="color: var(--color-clay);">&#9670;</span> Social Media &amp; Artisan Showcase Channels
            </h3>
            <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 2rem;">
                Links displayed in the site footer, mobile navigation drawer, and customer communications.
            </p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Instagram Profile URL</label>
                    <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings['instagram_url'] ?? 'https://instagram.com/oreonliving') }}" placeholder="https://instagram.com/yourhandle">
                    @error('instagram_url') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Facebook Page URL</label>
                    <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $settings['facebook_url'] ?? 'https://facebook.com/oreonliving') }}" placeholder="https://facebook.com/yourpage">
                    @error('facebook_url') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Pinterest Portfolio URL</label>
                    <input type="url" name="pinterest_url" class="form-control" value="{{ old('pinterest_url', $settings['pinterest_url'] ?? '') }}" placeholder="https://pinterest.com/yourhandle">
                    @error('pinterest_url') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">YouTube Studio Channel URL</label>
                    <input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" placeholder="https://youtube.com/@yourchannel">
                    @error('youtube_url') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 5: SEO Defaults (Item 48, 81, 165) -->
    <div id="tab-seo" class="settings-tab-pane">
        <div class="card" style="padding: 2rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <span style="color: var(--color-clay);">&#9670;</span> Search Engine Optimization (Default Metadata)
            </h3>
            <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 2rem;">
                Default title, meta description, and keywords used on homepage and fallback pages when specific product SEO tags are not set.
            </p>

            <div class="form-group">
                <label class="form-label">Default Site Meta Title</label>
                <input type="text" name="meta_title_default" class="form-control" value="{{ old('meta_title_default', $settings['meta_title_default'] ?? 'Oreon Living | Natural Earthen Clay & Terracotta Lifestyle') }}" placeholder="e.g. Oreon Living | Natural Earthen Clay & Terracotta Lifestyle">
                <span style="font-size: 0.75rem; color: var(--color-text-muted);">Recommended length: 50-60 characters for optimal Google search snippet appearance.</span>
                @error('meta_title_default') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Default Site Meta Description</label>
                <textarea name="meta_description_default" rows="3" class="form-control" placeholder="Discover handcrafted porous terracotta water carafes, botanical planters, and pure clay cookware. Mindfully designed for everyday living.">{{ old('meta_description_default', $settings['meta_description_default'] ?? 'Discover handcrafted porous terracotta water carafes, botanical planters, and pure clay cookware. Mindfully designed for everyday living.') }}</textarea>
                <span style="font-size: 0.75rem; color: var(--color-text-muted);">Recommended length: 140-160 characters.</span>
                @error('meta_description_default') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Default Meta Keywords</label>
                <input type="text" name="meta_keywords_default" class="form-control" value="{{ old('meta_keywords_default', $settings['meta_keywords_default'] ?? 'terracotta, earthen pottery, clay cookware, Indian pottery, handcrafted carafes, botanical planters') }}" placeholder="terracotta, earthen water pot, clay cooking pot, unglazed planter">
                @error('meta_keywords_default') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- TAB 6: Analytics, Pixels & Search Console (Item 74, 76, 77, 173) -->
    <div id="tab-tracking" class="settings-tab-pane">
        <div class="card" style="padding: 2rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <span style="color: var(--color-clay);">&#9670;</span> Analytics, Meta Pixel &amp; Verification Tags
            </h3>
            <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 2rem;">
                Inject your live tracking pixels and search engine verification codes directly into the storefront &lt;head&gt;.
            </p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Meta (Facebook &amp; Instagram) Pixel ID</label>
                    <input type="text" name="meta_pixel_id" class="form-control" value="{{ old('meta_pixel_id', $settings['meta_pixel_id'] ?? '') }}" placeholder="e.g. 123456789012345">
                    <span style="font-size: 0.75rem; color: var(--color-text-muted);">
                        Automatically activates the Meta Pixel script and tracks standard events (ViewContent, AddToCart, Purchase).
                    </span>
                    @error('meta_pixel_id') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Google Analytics 4 Measurement ID</label>
                    <input type="text" name="google_analytics_id" class="form-control" value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}" placeholder="e.g. G-XXXXXXXXXX">
                    <span style="font-size: 0.75rem; color: var(--color-text-muted);">
                        Automatically injects the GA4 gtag.js snippet across all storefront pages.
                    </span>
                    @error('google_analytics_id') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1; margin-bottom: 0;">
                    <label class="form-label">Google Search Console Verification Meta Tag Value</label>
                    <input type="text" name="google_search_console_tag" class="form-control" value="{{ old('google_search_console_tag', $settings['google_search_console_tag'] ?? '') }}" placeholder="e.g. AbCdEf1234567890 (or full meta content value)">
                    <span style="font-size: 0.75rem; color: var(--color-text-muted);">
                        Renders <code>&lt;meta name="google-site-verification" content="..."&gt;</code> in the homepage header for automatic verification.
                    </span>
                    @error('google_search_console_tag') <span class="text-xs" style="color: var(--color-danger);">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Action Bar -->
    <div style="margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem; padding: 1.25rem 0; border-top: 1px solid var(--color-border);">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem;">
            Save All Settings
        </button>
    </div>
</form>

<script>
    function switchTab(tabId, btnElement) {
        // Deactivate all tab buttons
        document.querySelectorAll('.settings-tab-btn').forEach(btn => btn.classList.remove('active'));
        // Hide all tab panes
        document.querySelectorAll('.settings-tab-pane').forEach(pane => pane.classList.remove('active'));

        // Activate selected
        btnElement.classList.add('active');
        const activePane = document.getElementById('tab-' + tabId);
        if (activePane) {
            activePane.classList.add('active');
        }
    }
</script>

<style>
    .settings-tab-btn {
        padding: 0.75rem 1.25rem;
        background: transparent;
        border: none;
        border-bottom: 2px solid transparent;
        font-family: var(--font-body);
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-text-muted);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
        transition: all 0.2s ease;
        margin-bottom: -2px;
    }
    .settings-tab-btn:hover {
        color: var(--color-text);
    }
    .settings-tab-btn.active {
        color: var(--color-clay);
        border-bottom-color: var(--color-clay);
    }
    .settings-tab-pane {
        display: none;
        animation: fadeIn 0.25s ease-in-out;
    }
    .settings-tab-pane.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(4px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection


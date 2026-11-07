<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageDesignTest extends TestCase
{
    public function test_homepage_loads_with_klayvi_design_tokens_and_sections(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // 1. Google Fonts Pairing
        $response->assertSee('Ibarra+Real+Nova', false);
        $response->assertSee('Manrope', false);

        // 2. Klayvi Signature Typographic Rhythm
        $response->assertSee('BRINGING NATURE', false);
        $response->assertSee('to your', false);
        $response->assertSee('HOME', false);

        // 3. Editorial Hero Section
        $response->assertSee('hero-editorial', false);
        $response->assertSee('hero-editorial-grid', false);
        $response->assertSee('hero-image-frame', false);
        $response->assertSee('100% Bio-Active Earth', false);

        // 4. The Earth Standard (Value Bar)
        $response->assertSee('value-bar', false);
        $response->assertSee('Natural Alkaline Balance', false);
        $response->assertSee('Zero Synthetic Toxins', false);
        $response->assertSee('Multi-Generational Wheels', false);
        $response->assertSee('Zero-Breakage Guarantee', false);

        // 5. Curated Collections Mosaic Grid
        $response->assertSee('collections-mosaic', false);
        $response->assertSee('collection-tile', false);
        $response->assertSee('Water Carafes & Coolers', false);
        $response->assertSee('Botanical Planters', false);
        $response->assertSee('Clay Cookware', false);
        $response->assertSee('Tableware & Dining', false);

        // 6. Quote Immersion Banner (Obsidian Contrast)
        $response->assertSee('quote-banner-dark', false);
        $response->assertSee('Clay is not merely inert soil', false);
        $response->assertSee('RAMACHANDRAN K.', false);

        // 7. The Zero-Toxin Standard Matrix
        $response->assertSee('THE ZERO-TOXIN', false);
        $response->assertSee('trust-matrix-grid', false);
        $response->assertSee('trust-matrix-card', false);
        $response->assertSee('100% Nutrient Retention', false);
        $response->assertSee('Zero Microplastics & PFAS', false);
        $response->assertSee('Natural Alkaline Buffer', false);
        $response->assertSee('River Stone Burnishing', false);

        // 8. Soil to Soul Heritage Split
        $response->assertSee('soil-soul-section', false);
        $response->assertSee('soil-soul-grid', false);
        $response->assertSee('From SOIL', false);
        $response->assertSee('to</span> SOUL', false);

        // 9. Community Dispatch
        $response->assertSee('COMMUNITY DISPATCH', false);
        $response->assertSee('SOIL-TO-SOUL', false);
        $response->assertSee('dispatch-form', false);
    }
}


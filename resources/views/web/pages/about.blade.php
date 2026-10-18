@extends('layouts.app')

@section('title', 'Our Story & Craft Philosophy | Oreon Living')
@section('meta_description', 'Discover the story of Oreon Living: pure riverbed clay, Indian artisan legacies, and mindful home objects.')

@section('content')
<div class="container section-tight">
    <!-- Editorial Hero -->
    <div style="max-width: 820px; margin: 2rem auto 4rem; text-align: center;">
        <span class="text-uppercase text-xs text-clay">The Oreon Living Philosophy</span>
        <h1 style="font-size: clamp(2.5rem, 5vw, 4rem); margin: 0.75rem 0 1.5rem; line-height: 1.15;">
            Born from Riverbed Mud.<br>Crafted for Everyday Rituals.
        </h1>
        <p class="lead-text">
            We believe the objects we touch every day shape our state of mind. Natural unglazed clay grounds the modern home in timeless equilibrium.
        </p>
    </div>

    <!-- Editorial Full Width Image -->
    <div style="aspect-ratio: 21/9; border-radius: var(--radius-sm); overflow: hidden; margin-bottom: 5rem; border: 1px solid var(--color-border); background-color: var(--color-surface-subtle);">
        <img src="https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=1600&q=85" alt="Pottery Studio Clay Craft" style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <!-- 2-Column Story Sections -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; margin-bottom: 5rem;" class="about-grid">
        <div>
            <span class="text-uppercase text-xs text-clay">Chapter I</span>
            <h2 style="font-size: 2.25rem; margin: 0.5rem 0 1.25rem;">Why Natural Clay?</h2>
            <p style="color: var(--color-text-muted); line-height: 1.8; margin-bottom: 1.25rem;">
                Modern industrial homeware has traded porous tactility for impenetrable synthetic coatings, steel, and plastics. While convenient, they sever our connection with nature's quiet physics.
            </p>
            <p style="color: var(--color-text-muted); line-height: 1.8;">
                Terracotta lives. Its microscopic pore network breathes, drawing warmth out of liquids to cool water by up to 5&deg;C without electricity. In the kitchen, its natural alkalinity gently neutralizes excess acidity in cooking, producing curds with silky density and curries infused with unmatched depth.
            </p>
        </div>
        <div style="aspect-ratio: 4/5; border-radius: var(--radius-sm); overflow: hidden; background-color: var(--color-surface-subtle); border: 1px solid var(--color-border);">
            <img src="https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1000&q=85" alt="Handcrafted terracotta water pot" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; margin-bottom: 5rem;" class="about-grid reverse-mobile">
        <div style="aspect-ratio: 4/5; border-radius: var(--radius-sm); overflow: hidden; background-color: var(--color-surface-subtle); border: 1px solid var(--color-border);">
            <img src="https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=1000&q=85" alt="Artisan shaping clay on wheel" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div>
            <span class="text-uppercase text-xs text-clay">Chapter II</span>
            <h2 style="font-size: 2.25rem; margin: 0.5rem 0 1.25rem;">The Living Maker Network</h2>
            <p style="color: var(--color-text-muted); line-height: 1.8; margin-bottom: 1.25rem;">
                Oreon Living collaborates directly with artisan clusters across rural Gujarat, Rajasthan, and Karnataka. These are master potters whose lineages have preserved the wheel, burnishing techniques, and slow firewood kiln firings for centuries.
            </p>
            <p style="color: var(--color-text-muted); line-height: 1.8;">
                We pay fair, above-market wages and commit to steady year-round production cycles, ensuring this invaluable tactile heritage continues to flourish for future generations.
            </p>
        </div>
    </div>

    <!-- Craft Guarantees -->
    <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(2rem, 5vw, 4rem); margin-bottom: 5rem; text-align: center;">
        <span class="text-uppercase text-xs text-clay">Our Promise</span>
        <h2 style="margin: 0.5rem 0 1rem;">Zero Synthetic Additives</h2>
        <p class="lead-text" style="max-width: 650px; margin: 0 auto 3rem;">
            Every Oreon Living piece is certified 100% free of lead, cadmium, synthetic lacquers, and chemical sealants. Pure earth, pure water, pure fire.
        </p>

        <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg">Explore the Collections</a>
    </div>
</div>

<style>
@media (max-width: 860px) {
    .about-grid {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }
}
</style>
@endsection

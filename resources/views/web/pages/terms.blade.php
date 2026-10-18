@extends('layouts.app')

@section('title', 'Terms & Conditions | Oreon Living')

@section('content')
<div class="container section-tight">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <span>Terms & Conditions</span>
    </nav>

    <div style="max-width: 780px; margin: 0 auto 5rem; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(2rem, 5vw, 4rem);">
        <span class="text-uppercase text-xs text-clay">Legal</span>
        <h1 style="font-size: 2.25rem; margin: 0.5rem 0 1.5rem;">Terms &amp; Conditions</h1>

        <div style="color: var(--color-text-muted); line-height: 1.8; font-size: 0.9375rem; display: flex; flex-direction: column; gap: 1.5rem;">
            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">1. General Agreement</h3>
                <p>By accessing or purchasing from the Oreon Living digital storefront, you agree to comply with these terms, governing orders, returns, intellectual property, and artisanal product tolerances.</p>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">2. Pricing & Currency</h3>
                <p>All prices listed on Oreon Living are in Indian Rupees (INR) and are inclusive of statutory goods and services taxes (GST). Shipping charges are computed dynamically at checkout based on subtotal thresholds.</p>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">3. Handmade Pottery Tolerances</h3>
                <p>Our pieces are made by human hands on potter's wheels without robotic casting. Dimensions and weights stated on product pages carry an approximate &plusmn;5% artisanal tolerance, reflecting genuine studio craft.</p>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">4. Intellectual Property</h3>
                <p>All trademarks, custom photography, product descriptions, visual layouts, and brand assets are the exclusive property of Oreon Living Private Limited.</p>
            </div>
        </div>
    </div>
</div>
@endsection

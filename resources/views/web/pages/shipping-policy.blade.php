@extends('layouts.app')

@section('title', 'Shipping & Breakage Guarantee Policy | Oreon Living')

@section('content')
<div class="container section-tight">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <span>Shipping Policy</span>
    </nav>

    <div style="max-width: 780px; margin: 0 auto 5rem; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(2rem, 5vw, 4rem);">
        <span class="text-uppercase text-xs text-clay">Logistics & Care</span>
        <h1 style="font-size: 2.25rem; margin: 0.5rem 0 1.5rem;">Shipping &amp; Breakage Guarantee</h1>

        <div style="color: var(--color-text-muted); line-height: 1.8; font-size: 0.9375rem; display: flex; flex-direction: column; gap: 1.5rem;">
            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">1. Free Delivery Threshold</h3>
                <p>We provide complimentary standard shipping across all serviceable Indian postal PIN codes on all orders of ₹1,999 and above. For orders below ₹1,999, a nominal flat packaging and courier fee of ₹149 is applied at checkout.</p>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">2. 100% Zero-Breakage Transit Guarantee</h3>
                <p>Because earthen terracotta is fragile, we have engineered custom multi-ply corrugated paper cushioning and molded honeycombing. If your piece arrives broken or cracked due to courier handling, we replace it 100% free of charge. Simply send a photo of the unboxed item on WhatsApp within 48 hours of delivery.</p>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">3. Dispatch &amp; Delivery Timelines</h3>
                <p>Every piece undergoes quality inspection before packing. Orders are dispatched from our Bengaluru workshop within 24–48 business hours. Typical delivery windows:</p>
                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                    <li>Metro Cities (Delhi, Mumbai, Bengaluru, Chennai, Hyderabad): 2 to 4 business days.</li>
                    <li>Rest of India: 4 to 7 business days.</li>
                </ul>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">4. Real-time Tracking</h3>
                <p>Once dispatched, you will receive real-time courier tracking details via email and WhatsApp. You can also view live tracking updates anytime in your <a href="{{ route('account.orders') }}" style="color: var(--color-clay); text-decoration: underline;">Account Order History</a>.</p>
            </div>
        </div>
    </div>
</div>
@endsection

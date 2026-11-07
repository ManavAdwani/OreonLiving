@extends('layouts.app')

@section('title', 'Return & Replacement Policy | Oréon Living')

@section('content')
<div class="container section-tight">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <span>Return & Refund Policy</span>
    </nav>

    <div style="max-width: 780px; margin: 0 auto 5rem; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(2rem, 5vw, 4rem);">
        <span class="text-uppercase text-xs text-clay">Customer Assurance</span>
        <h1 style="font-size: 2.25rem; margin: 0.5rem 0 1.5rem;">Return &amp; Refund Policy</h1>

        <div style="color: var(--color-text-muted); line-height: 1.8; font-size: 0.9375rem; display: flex; flex-direction: column; gap: 1.5rem;">
            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">1. 7-Day Doorstep Replacement Guarantee</h3>
                <p>We want you to adore every vessel in your home. If a piece arrives damaged, defective, or noticeably mismatched in dimension from what was ordered, you may submit a return request within 7 calendar days of delivery via your customer portal or concierge WhatsApp.</p>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">2. Natural Material Characteristics</h3>
                <p>Because each piece is individually hand-thrown on the potter's wheel and fired in wood kilns, slight variations in terracotta grain, wood ash speckling, and surface tones are organic hallmarks of authentic craftsmanship rather than defects.</p>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">3. Return Process</h3>
                <p>To request a return or replacement:</p>
                <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                    <li>Log in to your account and navigate to <a href="{{ route('account.orders') }}" style="color: var(--color-clay); text-decoration: underline;">Order History</a>.</li>
                    <li>Click on the delivered order and select "Request Return / Replacement".</li>
                    <li>Our team arranges reverse pickup from your doorstep within 48 hours.</li>
                </ol>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">4. Refunds</h3>
                <p>Upon verification of the returned item at our studio, refunds are credited back to the original payment source (UPI account or card) within 5–7 business days.</p>
            </div>
        </div>
    </div>
</div>
@endsection

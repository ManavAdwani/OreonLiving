@extends('layouts.app')

@section('title', 'Privacy Policy | Oreon Living')

@section('content')
<div class="container section-tight">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <span>Privacy Policy</span>
    </nav>

    <div style="max-width: 780px; margin: 0 auto 5rem; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(2rem, 5vw, 4rem);">
        <span class="text-uppercase text-xs text-clay">Data Protection</span>
        <h1 style="font-size: 2.25rem; margin: 0.5rem 0 1.5rem;">Privacy Policy</h1>

        <div style="color: var(--color-text-muted); line-height: 1.8; font-size: 0.9375rem; display: flex; flex-direction: column; gap: 1.5rem;">
            <p>At Oreon Living, your personal information is treated with the same mindful care as our craft. We do not sell, rent, or trade customer data to any third-party marketing brokers.</p>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">Information We Collect</h3>
                <p>We collect customer contact names, shipping addresses, telephone numbers, and email credentials solely for fulfilling shipments, calculating pin code serviceability, issuing tax invoices, and communicating live order status.</p>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">Payment Security</h3>
                <p>All online payments through UPI, Cards, and Netbanking are securely processed using encrypted banking protocols (NPCI and PCI-DSS Level 1 compliant gateways). We never store debit or credit card CVV numbers on our servers.</p>
            </div>

            <div>
                <h3 style="font-size: 1.25rem; color: var(--color-text); margin-bottom: 0.5rem;">Cookies & Analytics</h3>
                <p>We use essential cookies to maintain shopping cart items, guest session carts, and remember account logins. Anonymized analytics may be utilized to monitor site speed and optimize navigation.</p>
            </div>
        </div>
    </div>
</div>
@endsection

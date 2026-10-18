@extends('layouts.app')

@section('title', 'Order #' . $order->order_number . ' | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('account.dashboard') }}">My Account</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('account.orders') }}">Orders</a>
        <span class="breadcrumb-separator">/</span>
        <span>#{{ $order->order_number }}</span>
    </nav>

    <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(1.5rem, 4vw, 3rem); margin-bottom: 4rem;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid var(--color-border); padding-bottom: 1.5rem; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="text-uppercase text-xs text-clay">Order Details</span>
                <h1 style="font-size: 2rem; margin: 0.25rem 0 0.5rem;">#{{ $order->order_number }}</h1>
                <p style="font-size: 0.875rem; color: var(--color-text-muted);">
                    Placed on {{ $order->created_at->format('d M Y, h:i A') }} &bull; Payment: {{ strtoupper($order->payment_method) }} ({{ ucfirst($order->payment_status) }})
                </p>
            </div>
            <div class="flex gap-2" style="flex-wrap: wrap;">
                <span class="badge {{ $order->status_badge_class }}" style="font-size: 0.875rem; padding: 0.5rem 1rem;">
                    Status: {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                </span>
                <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" class="btn btn-secondary btn-sm">
                    Tax Invoice
                </a>
            </div>
        </div>

        <!-- Live Shipment Tracking Progress Bar (PDF item 111, 112, 113) -->
        <div style="background: var(--color-surface-subtle); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 2rem; margin-bottom: 2.5rem;">
            <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem;">Fulfillment &amp; Delivery Progress</h3>

            @php
                $steps = ['pending' => 'Pending', 'confirmed' => 'Confirmed', 'processing' => 'Handcrafted Packing', 'shipped' => 'Dispatched', 'delivered' => 'Delivered'];
                $currentIdx = array_search($order->order_status, array_keys($steps));
                if ($currentIdx === false) $currentIdx = 0;
            @endphp

            @if(in_array($order->order_status, ['cancelled', 'return_requested', 'refunded']))
                <div class="alert alert-warning">
                    <strong>Status Notice:</strong> This order is currently marked as <u>{{ strtoupper(str_replace('_', ' ', $order->order_status)) }}</u>.
                    @if($order->cancellation_reason)
                        <span style="display: block; margin-top: 0.25rem;">Reason: {{ $order->cancellation_reason }}</span>
                    @endif
                    @if($order->return_reason)
                        <span style="display: block; margin-top: 0.25rem;">Reason: {{ $order->return_reason }}</span>
                    @endif
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 0.5rem; text-align: center; position: relative;">
                    @foreach($steps as $key => $label)
                        @php $stepIdx = array_search($key, array_keys($steps)); @endphp
                        <div>
                            <div style="width: 32px; height: 32px; border-radius: var(--radius-full); margin: 0 auto 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; {{ $stepIdx <= $currentIdx ? 'background: var(--color-clay); color: #FFF;' : 'background: #E5E7EB; color: #9CA3AF;' }}">
                                {{ $stepIdx + 1 }}
                            </div>
                            <span style="font-size: 0.75rem; font-weight: {{ $stepIdx <= $currentIdx ? '600' : '400' }}; color: {{ $stepIdx <= $currentIdx ? 'var(--color-text)' : 'var(--color-text-muted)' }};">
                                {{ $label }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($order->tracking_number)
                <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem; font-size: 0.875rem;">
                    <div>
                        <strong>Carrier:</strong> {{ $order->carrier_name ?: 'Express Air Logistics' }} &bull; 
                        <strong>Tracking Number:</strong> <span style="font-family: monospace;">{{ $order->tracking_number }}</span>
                    </div>
                    @if($order->tracking_url)
                        <a href="{{ $order->tracking_url }}" target="_blank" class="btn btn-dark btn-sm">
                            Open Courier Tracking Portal &rarr;
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <!-- Ordered Items Table -->
        <div style="border: 1px solid var(--color-border); border-radius: var(--radius-sm); overflow: hidden; margin-bottom: 2.5rem;">
            <div style="background: var(--color-surface-subtle); padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted);">
                Items in This Shipment
            </div>
            <div style="padding: 0 1.5rem;">
                @foreach($order->items as $item)
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 0; border-bottom: 1px solid var(--color-border-subtle); gap: 1rem;">
                        <div>
                            <h4 style="font-size: 1.05rem; font-weight: 600; margin-bottom: 0.25rem;">{{ $item->product_name }}</h4>
                            <span style="font-size: 0.8125rem; color: var(--color-text-muted);">SKU: {{ $item->sku }} &bull; Unit Price: ₹{{ number_format($item->price, 2) }}</span>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-size: 0.875rem; color: var(--color-text-muted);">Qty: {{ $item->quantity }}</span>
                            <div style="font-weight: 700; font-size: 1.1rem; color: var(--color-text); margin-top: 0.2rem;">
                                ₹{{ number_format($item->total, 2) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="background: var(--color-surface-subtle); padding: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.9375rem;">
                <div class="flex justify-between">
                    <span class="text-muted">Subtotal:</span>
                    <span>₹{{ number_format($order->subtotal, 2) }}</span>
                </div>
                @if($order->discount > 0)
                    <div class="flex justify-between" style="color: var(--color-clay);">
                        <span>Promotional Discount:</span>
                        <span>&minus; ₹{{ number_format($order->discount, 2) }}</span>
                    </div>
                @endif
                <div class="flex justify-between">
                    <span class="text-muted">Packaging &amp; Pan-India Shipping:</span>
                    <span>{{ $order->shipping_fee == 0 ? 'FREE' : '₹' . number_format($order->shipping_fee, 2) }}</span>
                </div>
                <div class="flex justify-between" style="font-size: 1.25rem; font-weight: 700; border-top: 1px solid var(--color-border); padding-top: 0.75rem; margin-top: 0.25rem;">
                    <span>Grand Total:</span>
                    <span>₹{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Cancellation & Return Actions (PDF item 114, 115) -->
        <div style="border-top: 1px solid var(--color-border); padding-top: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                @if($order->canBeCancelled())
                    <button type="button" onclick="document.getElementById('cancelModal').style.display='flex'" class="btn btn-secondary" style="color: var(--color-danger); border-color: #FCA5A5;">
                        Request Order Cancellation
                    </button>
                @elseif($order->canBeReturned())
                    <button type="button" onclick="document.getElementById('returnModal').style.display='flex'" class="btn btn-secondary">
                        Request 7-Day Return / Replacement
                    </button>
                @endif
            </div>

            <!-- WhatsApp Support -->
            <a href="https://wa.me/{{ \App\Models\WebsiteSetting::get('whatsapp_number', '919876543210') }}?text={{ urlencode("Hello Oreon Living, I need assistance regarding Order #{$order->order_number}") }}" target="_blank" rel="noopener" class="btn btn-secondary btn-sm" style="color: #25D366; border-color: #25D366;">
                Need help with this order? Chat on WhatsApp
            </a>
        </div>
    </div>
</div>

<!-- Cancellation Modal (PDF item 114) -->
@if($order->canBeCancelled())
<div id="cancelModal" style="display:none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #FFFFFF; border-radius: var(--radius-sm); max-width: 480px; width: 100%; padding: 2rem; box-shadow: var(--shadow-modal);">
        <h3 style="font-size: 1.35rem; margin-bottom: 0.5rem;">Cancel Order #{{ $order->order_number }}</h3>
        <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 1.5rem;">Are you sure you want to cancel this order? Stock will be restored and any payment refunded.</p>
        
        <form action="{{ route('account.orders.cancel', $order->order_number) }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Reason for Cancellation *</label>
                <textarea name="reason" rows="3" required placeholder="Please let us know why you wish to cancel..." class="form-control"></textarea>
            </div>
            <div class="flex gap-2 justify-between" style="margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('cancelModal').style.display='none'" class="btn btn-secondary">Back</button>
                <button type="submit" class="btn btn-primary" style="background-color: var(--color-danger);">Confirm Cancellation</button>
            </div>
        </form>
    </div>
</div>
@endif

<!-- Return Request Modal (PDF item 115) -->
@if($order->canBeReturned())
<div id="returnModal" style="display:none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #FFFFFF; border-radius: var(--radius-sm); max-width: 480px; width: 100%; padding: 2rem; box-shadow: var(--shadow-modal);">
        <h3 style="font-size: 1.35rem; margin-bottom: 0.5rem;">Request Return / Replacement</h3>
        <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 1.5rem;">Our concierge will arrange a doorstep pickup. Please describe the condition or reason.</p>
        
        <form action="{{ route('account.orders.return', $order->order_number) }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Return Reason *</label>
                <textarea name="reason" rows="3" required placeholder="Describe issue (e.g. transit damage, size mismatch)..." class="form-control"></textarea>
            </div>
            <div class="flex gap-2 justify-between" style="margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('returnModal').style.display='none'" class="btn btn-secondary">Back</button>
                <button type="submit" class="btn btn-dark">Submit Return Request</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection

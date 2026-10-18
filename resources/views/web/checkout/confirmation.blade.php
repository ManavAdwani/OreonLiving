@extends('layouts.app')

@section('title', 'Order Confirmed #' . $order->order_number . ' | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Success Banner -->
    <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(2rem, 5vw, 4rem); max-width: 850px; margin: 0 auto 3rem; text-align: center;">
        <div style="width: 72px; height: 72px; border-radius: var(--radius-full); background: var(--color-success-bg); color: var(--color-success); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>

        <span class="badge badge-success" style="margin-bottom: 0.75rem;">Order Successfully Placed</span>
        <h1 style="font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 0.5rem;">Thank You, {{ $order->customer_name }}</h1>
        <p class="lead-text" style="margin-bottom: 1.5rem;">
            Your order <strong>#{{ $order->order_number }}</strong> has been recorded and scheduled for dispatch from our Bengaluru studio.
        </p>

        <div class="flex justify-center gap-2" style="flex-wrap: wrap; margin-bottom: 2rem;">
            <!-- WhatsApp Order Confirmation (PDF item 110, 150) -->
            <a href="{{ $whatsappOrderUrl }}" target="_blank" rel="noopener noreferrer" 
               class="btn" style="background-color: #25D366; color: #FFFFFF;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFFFFF"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2z"></path></svg>
                <span>Send Confirmation on WhatsApp</span>
            </a>

            <!-- Download Invoice (PDF item 117) -->
            <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" class="btn btn-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                <span>Printable Tax Invoice</span>
            </a>

            <a href="{{ route('shop.index') }}" class="btn btn-dark">Continue Shopping</a>
        </div>

        <!-- UPI Payment Block (PDF item 24) -->
        @if($order->payment_method === 'upi')
            <div style="background-color: var(--color-surface-subtle); border: 1.5px dashed var(--color-clay); border-radius: var(--radius-sm); padding: 2rem; max-width: 500px; margin: 0 auto 2.5rem; text-align: center;">
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--color-clay);">Complete Your UPI Payment</h3>
                <p style="font-size: 0.8125rem; color: var(--color-text-muted); margin-bottom: 1.25rem;">
                    Scan the QR code below using any UPI App (GPay, PhonePe, Paytm, CRED) or use the UPI ID:
                </p>

                <!-- Dynamic QR Code (PDF item 24) -->
                <div style="width: 180px; height: 180px; margin: 0 auto 1.25rem; background: #FFFFFF; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--color-border); box-shadow: var(--shadow-subtle);">
                    <img src="{{ $upiData['qr_code_url'] }}" alt="UPI QR Code" style="width: 100%; height: 100%;">
                </div>

                <div style="background: #FFFFFF; border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 0.65rem 1rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span style="font-family: monospace; font-size: 0.9375rem; font-weight: 600;">{{ $upiData['vpa'] }}</span>
                    <button type="button" onclick="navigator.clipboard.writeText('{{ $upiData['vpa'] }}'); alert('UPI ID copied to clipboard!');" style="font-size: 0.75rem; color: var(--color-clay); font-weight: 600; text-transform: uppercase;">Copy</button>
                </div>

                <a href="{{ $upiData['upi_link'] }}" class="btn btn-primary btn-block btn-sm">
                    Open UPI App on Mobile &rarr;
                </a>
            </div>
        @endif

        <!-- Order Summary Details -->
        <div style="border-top: 1px solid var(--color-border); padding-top: 2rem; text-align: left;">
            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <h4 style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-text-muted); margin-bottom: 0.5rem; font-weight: 600;">Shipping To</h4>
                    <p style="font-weight: 600; font-size: 0.9375rem;">{{ $order->shipping_address['name'] ?? $order->customer_name }}</p>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6;">
                        {{ $order->shipping_address['address_line_1'] ?? '' }}, 
                        {{ $order->shipping_address['address_line_2'] ?? '' }}<br>
                        {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} &ndash; {{ $order->shipping_address['postal_code'] ?? '' }}<br>
                        Phone: {{ $order->shipping_address['phone'] ?? $order->customer_phone }}
                    </p>
                </div>

                <div>
                    <h4 style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-text-muted); margin-bottom: 0.5rem; font-weight: 600;">Order & Payment Info</h4>
                    <p style="font-size: 0.875rem; color: var(--color-text); margin-bottom: 0.35rem;">
                        <strong>Order Status:</strong> <span class="badge {{ $order->status_badge_class }}">{{ ucfirst($order->order_status) }}</span>
                    </p>
                    <p style="font-size: 0.875rem; color: var(--color-text); margin-bottom: 0.35rem;">
                        <strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }} ({{ ucfirst($order->payment_status) }})
                    </p>
                    <p style="font-size: 0.875rem; color: var(--color-text);">
                        <strong>Placed On:</strong> {{ $order->created_at->format('d M Y, h:i A') }}
                    </p>
                </div>
            </div>

            <!-- Ordered Items List -->
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-sm); overflow: hidden;">
                <div style="background: var(--color-surface-subtle); padding: 0.85rem 1.25rem; font-weight: 600; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted);">
                    Ordered Pieces
                </div>
                <div style="padding: 0 1.25rem;">
                    @foreach($order->items as $item)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-bottom: 1px solid var(--color-border-subtle);">
                            <div>
                                <h5 style="font-size: 0.9375rem; font-weight: 600; margin-bottom: 0.2rem;">{{ $item->product_name }}</h5>
                                <span style="font-size: 0.75rem; color: var(--color-text-muted);">Qty: {{ $item->quantity }} &bull; SKU: {{ $item->sku }}</span>
                            </div>
                            <span style="font-weight: 700; font-size: 0.9375rem;">₹{{ number_format($item->total, 2) }}</span>
                        </div>
                    @endforeach
                </div>
                <div style="background: var(--color-surface-subtle); padding: 1.25rem; display: flex; flex-direction: column; gap: 0.4rem; font-size: 0.875rem;">
                    <div class="flex justify-between">
                        <span class="text-muted">Subtotal:</span>
                        <span>₹{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->discount > 0)
                        <div class="flex justify-between" style="color: var(--color-clay);">
                            <span>Discount:</span>
                            <span>&minus; ₹{{ number_format($order->discount, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-muted">Shipping:</span>
                        <span>{{ $order->shipping_fee == 0 ? 'FREE' : '₹' . number_format($order->shipping_fee, 2) }}</span>
                    </div>
                    <div class="flex justify-between" style="font-size: 1.125rem; font-weight: 700; border-top: 1px solid var(--color-border); padding-top: 0.5rem; margin-top: 0.25rem;">
                        <span>Total Paid / Payable:</span>
                        <span>₹{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

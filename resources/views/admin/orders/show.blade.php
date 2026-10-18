@extends('layouts.admin')

@section('header_title', 'Order Fulfillment: #' . $order->order_number)

@section('content')
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;" class="admin-order-layout">
    <!-- Left: Order Details & Status Form -->
    <div>
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h3 class="admin-card-title">Order #{{ $order->order_number }}</h3>
                    <span style="font-size: 0.8125rem; color: var(--admin-text-muted);">
                        Placed on {{ $order->created_at->format('d M Y, h:i A') }} &bull; Source: <strong>{{ $order->utm_source ?: 'Direct' }}</strong>
                    </span>
                </div>
                <div class="flex gap-1">
                    <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" class="btn btn-secondary btn-sm">
                        Print Tax Invoice &nearr;
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Orders</a>
                </div>
            </div>

            <!-- Status Transition & Tracking Form (PDF item 41, 68, 69, 112, 113) -->
            @if(!auth()->user()->isViewer())
                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" style="padding: 1.5rem; background: #F9FAFB; border-bottom: 1px solid var(--admin-border);">
                    @csrf

                    <h4 style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-clay); margin-bottom: 1rem; font-weight: 600;">
                        Update Fulfillment Status &amp; Shipping Tracking
                    </h4>

                    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div class="form-group">
                            <label class="form-label">Order Fulfillment Status *</label>
                            <select name="order_status" class="form-control">
                                @foreach(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled', 'return_requested', 'refunded'] as $st)
                                    <option value="{{ $st }}" {{ $order->order_status === $st ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $st)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Payment Status *</label>
                            <select name="payment_status" class="form-control">
                                <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div class="form-group">
                            <label class="form-label">Courier / Shipping Partner (PDF item 141)</label>
                            <input type="text" name="carrier_name" value="{{ old('carrier_name', $order->carrier_name) }}" class="form-control" placeholder="e.g. Delhivery Express, Blue Dart, DTDC">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Airway Bill / Tracking Number (PDF item 112)</label>
                            <input type="text" name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}" class="form-control" placeholder="e.g. DELHIVERY892182910">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label class="form-label">Direct Courier Tracking URL Link (PDF item 113)</label>
                        <input type="url" name="tracking_url" value="{{ old('tracking_url', $order->tracking_url) }}" class="form-control" placeholder="https://www.delhivery.com/track/package/...">
                    </div>

                    <div class="form-group" style="margin-bottom: 1.25rem;">
                        <label class="form-label">Internal Fulfillment Notes</label>
                        <textarea name="notes" rows="2" class="form-control" placeholder="Internal notes for warehouse packing or logistics...">{{ old('notes', $order->notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Update Order &amp; Log Changes</button>
                </form>
            @endif

            <!-- Items Table -->
            <div style="padding: 1.5rem;">
                <h4 style="font-size: 1rem; margin-bottom: 1rem; font-weight: 600;">Ordered Pieces</h4>
                <table class="admin-table" style="margin-bottom: 1.5rem;">
                    <thead>
                        <tr>
                            <th>Piece Name</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->product_name }}</strong>
                                </td>
                                <td><span style="font-family: monospace;">{{ $item->sku }}</span></td>
                                <td>₹{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td style="text-align: right;"><strong>₹{{ number_format($item->total, 2) }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Financial Summary -->
                <div style="background: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: 6px; padding: 1.25rem; max-width: 380px; margin-left: auto;">
                    <div class="flex justify-between" style="font-size: 0.875rem; margin-bottom: 0.4rem;">
                        <span class="text-muted">Subtotal:</span>
                        <span>₹{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->discount > 0)
                        <div class="flex justify-between" style="font-size: 0.875rem; color: var(--color-clay); margin-bottom: 0.4rem;">
                            <span>Discount:</span>
                            <span>&minus; ₹{{ number_format($order->discount, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between" style="font-size: 0.875rem; margin-bottom: 0.4rem;">
                        <span class="text-muted">Shipping Fee:</span>
                        <span>₹{{ number_format($order->shipping_fee, 2) }}</span>
                    </div>
                    <div class="flex justify-between" style="font-size: 1.1rem; font-weight: 700; border-top: 1px solid var(--admin-border); padding-top: 0.5rem; margin-top: 0.5rem;">
                        <span>Grand Total:</span>
                        <span>₹{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Customer Info & WhatsApp Notify -->
    <div>
        <!-- WhatsApp Customer Update Button (PDF item 110, 150) -->
        <div class="admin-card" style="padding: 1.5rem; background: #F0FFF4; border: 1.5px solid #25D366; text-align: center; margin-bottom: 1.5rem;">
            <h4 style="font-size: 1rem; color: #1E7E34; margin-bottom: 0.5rem;">Notify Customer on WhatsApp</h4>
            <p style="font-size: 0.8125rem; color: #4B5563; margin-bottom: 1rem;">
                Send pre-filled status, tracking number, and delivery estimate directly to the customer's WhatsApp.
            </p>
            <a href="{{ $whatsappNotifyUrl }}" target="_blank" rel="noopener" class="btn btn-block" style="background-color: #25D366; color: #FFFFFF;">
                Open Customer Chat on WhatsApp &rarr;
            </a>
        </div>

        <!-- Customer Card -->
        <div class="admin-card" style="padding: 1.5rem; margin-bottom: 1.5rem;">
            <h4 style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--admin-text-muted); margin-bottom: 1rem; font-weight: 600;">
                Customer &amp; Delivery Destination
            </h4>

            <div style="font-size: 0.875rem; line-height: 1.6;">
                <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                
                <hr style="border: none; border-top: 1px solid var(--admin-border); margin: 0.75rem 0;">

                <p><strong>Shipping Address:</strong><br>
                    {{ $order->shipping_address['address_line_1'] ?? '' }}<br>
                    @if(!empty($order->shipping_address['address_line_2']))
                        {{ $order->shipping_address['address_line_2'] }}<br>
                    @endif
                    {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} &ndash; {{ $order->shipping_address['postal_code'] ?? '' }}<br>
                    {{ $order->shipping_address['country'] ?? 'India' }}
                </p>

                @if($order->cancellation_reason)
                    <div class="alert alert-danger" style="margin-top: 1rem; padding: 0.75rem; font-size: 0.8125rem;">
                        <strong>Cancellation Reason:</strong><br>{{ $order->cancellation_reason }}
                    </div>
                @endif

                @if($order->return_reason)
                    <div class="alert alert-warning" style="margin-top: 1rem; padding: 0.75rem; font-size: 0.8125rem;">
                        <strong>Return Reason:</strong><br>{{ $order->return_reason }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 900px) {
    .admin-order-layout {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection

@extends('layouts.app')

@section('title', 'Your Earthen Cart | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('shop.index') }}">Shop</a>
        <span class="breadcrumb-separator">/</span>
        <span>Cart</span>
    </nav>

    <h1 style="font-size: clamp(2rem, 3.5vw, 2.75rem); margin-bottom: 2rem;">Your Earthen Collection</h1>

    @if($cart->items->isEmpty())
        <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 5rem 2rem; text-align: center; max-width: 650px; margin: 0 auto 4rem;">
            <div style="width: 72px; height: 72px; border-radius: var(--radius-full); background: var(--color-surface-subtle); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: var(--color-text-muted);">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-2z"></path><line x1="3" y1="6" x2="21" y2="6"></line></svg>
            </div>
            <h3 style="margin-bottom: 0.5rem;">Your Cart is Empty</h3>
            <p class="text-muted" style="margin-bottom: 2rem; line-height: 1.6;">You have not added any earthen vessels or clay pieces to your shopping cart yet.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg">Explore All Pieces</a>
        </div>
    @else
        <!-- Free Shipping Progress Bar (PDF item 139) -->
        <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); padding: 1.25rem 1.5rem; border-radius: var(--radius-sm); margin-bottom: 2.5rem;">
            @if($amount_for_free_shipping > 0)
                <p style="font-size: 0.875rem; color: var(--color-text); margin-bottom: 0.6rem;">
                    Add <strong>₹{{ number_format($amount_for_free_shipping, 2) }}</strong> more to unlock <strong>Complimentary Pan-India Free Delivery</strong>!
                </p>
                @php
                    $pct = min(100, round(($subtotal / $free_shipping_threshold) * 100));
                @endphp
                <div style="height: 8px; background: var(--color-surface-subtle); border-radius: var(--radius-full); overflow: hidden;">
                    <div style="width: {{ $pct }}%; height: 100%; background: var(--color-clay); border-radius: var(--radius-full); transition: width var(--transition-base);"></div>
                </div>
            @else
                <div class="flex items-center gap-1" style="color: var(--color-success); font-weight: 600; font-size: 0.9375rem;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Congratulations! You qualify for Free Pan-India Delivery.</span>
                </div>
            @endif
        </div>

        <!-- 2-Column Cart Layout -->
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem; align-items: start;" class="cart-layout">
            <!-- Left: Items Table -->
            <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 1.125rem; font-weight: 600;">Items in Cart ({{ $items_count }})</h3>
                </div>

                <div style="padding: 0 1.5rem;">
                    @foreach($cart->items as $item)
                        <div style="display: flex; gap: 1.5rem; padding: 1.5rem 0; border-bottom: 1px solid var(--color-border-subtle); align-items: center;" class="cart-item-row">
                            <!-- Thumbnail -->
                            <a href="{{ route('product.show', $item->product->slug) }}" style="width: 80px; height: 100px; border-radius: var(--radius-sm); overflow: hidden; flex-shrink: 0; background: var(--color-surface-subtle); border: 1px solid var(--color-border);">
                                <img src="{{ $item->product->primary_image_url }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </a>

                            <!-- Info -->
                            <div style="flex: 1;">
                                <h4 style="font-size: 1.1rem; font-weight: 500; margin-bottom: 0.25rem;">
                                    <a href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                </h4>
                                @if($item->variant)
                                    <p style="font-size: 0.8125rem; color: var(--color-text-muted); margin-bottom: 0.35rem;">Option: {{ $item->variant->title }}</p>
                                @endif
                                <span style="font-weight: 600; font-size: 0.9375rem; color: var(--color-text);">₹{{ number_format($item->price, 2) }}</span>
                            </div>

                            <!-- Quantity Form -->
                            <div style="display: inline-flex; align-items: center; border: 1px solid var(--color-border); border-radius: var(--radius-sm); background: var(--color-bg);">
                                <form action="{{ route('cart.update') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                    <button type="submit" style="padding: 0.35rem 0.65rem; color: var(--color-text);">&minus;</button>
                                </form>
                                <span style="width: 32px; text-align: center; font-size: 0.875rem; font-weight: 600;">{{ $item->quantity }}</span>
                                <form action="{{ route('cart.update') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" style="padding: 0.35rem 0.65rem; color: var(--color-text);">&plus;</button>
                                </form>
                            </div>

                            <!-- Line Total -->
                            <div style="min-width: 90px; text-align: right;">
                                <span style="font-weight: 700; font-size: 1.05rem;">₹{{ number_format($item->total, 2) }}</span>
                            </div>

                            <!-- Remove Button -->
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" title="Remove piece" style="color: var(--color-text-light); padding: 0.4rem; transition: color var(--transition-fast);" onmouseover="this.style.color='var(--color-danger)'" onmouseout="this.style.color='var(--color-text-light)'">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div style="padding: 1.25rem 1.5rem; background: var(--color-surface-subtle); display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('shop.index') }}" style="font-size: 0.875rem; color: var(--color-clay); font-weight: 500;">&larr; Continue Exploring</a>
                    <span style="font-size: 0.8125rem; color: var(--color-text-muted);">Secure SSL Checkout Encrypted</span>
                </div>
            </div>

            <!-- Right: Order Summary & Coupon -->
            <div>
                <!-- Coupon Box -->
                <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 1.5rem; margin-bottom: 1.5rem;">
                    <h4 style="font-family: var(--font-body); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 600; margin-bottom: 0.75rem;">
                        Promotional Coupon
                    </h4>
                    @if($coupon)
                        <div class="flex justify-between items-center" style="background: var(--color-clay-light); border: 1px dashed var(--color-clay); padding: 0.65rem 1rem; border-radius: var(--radius-sm);">
                            <div>
                                <strong style="color: var(--color-clay); font-size: 0.875rem;">{{ $coupon->code }}</strong>
                                <span style="font-size: 0.75rem; color: var(--color-text-muted); display: block;">Saved ₹{{ number_format($discount, 2) }}</span>
                            </div>
                            <form action="{{ route('cart.coupon.remove') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="font-size: 0.75rem; color: var(--color-danger); text-decoration: underline;">Remove</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('cart.coupon') }}" method="POST" style="display: flex; gap: 0.5rem;">
                            @csrf
                            <input type="text" name="code" placeholder="e.g. WELCOME10" required class="form-control" style="text-transform: uppercase; font-size: 0.875rem; padding: 0.6rem 0.85rem;">
                            <button type="submit" class="btn btn-secondary btn-sm">Apply</button>
                        </form>
                        <p style="font-size: 0.75rem; color: var(--color-text-muted); margin-top: 0.5rem;">Try code <strong>WELCOME10</strong> for 10% off your first order.</p>
                    @endif
                </div>

                <!-- Financial Summary Box -->
                <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 1.5rem;">
                    <h4 style="font-family: var(--font-body); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 600; margin-bottom: 1.25rem;">
                        Order Summary
                    </h4>

                    <div style="display: flex; flex-direction: column; gap: 0.85rem; font-size: 0.9375rem; margin-bottom: 1.5rem;">
                        <div class="flex justify-between">
                            <span class="text-muted">Subtotal:</span>
                            <span style="font-weight: 600;">₹{{ number_format($subtotal, 2) }}</span>
                        </div>

                        @if($discount > 0)
                            <div class="flex justify-between" style="color: var(--color-clay);">
                                <span>Coupon Discount:</span>
                                <span style="font-weight: 600;">&minus; ₹{{ number_format($discount, 2) }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between">
                            <span class="text-muted">Estimated Shipping:</span>
                            @if($shipping == 0)
                                <span style="font-weight: 600; color: var(--color-success);">FREE</span>
                            @else
                                <span style="font-weight: 600;">₹{{ number_format($shipping, 2) }}</span>
                            @endif
                        </div>

                        <div class="flex justify-between text-xs text-muted" style="border-bottom: 1px solid var(--color-border-subtle); padding-bottom: 0.75rem;">
                            <span>Estimated 5% GST (Included):</span>
                            <span>₹{{ number_format($tax, 2) }}</span>
                        </div>

                        <div class="flex justify-between items-baseline" style="font-size: 1.25rem; font-weight: 700; color: var(--color-text);">
                            <span>Grand Total:</span>
                            <span>₹{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block btn-lg" style="margin-bottom: 1rem;">
                        Proceed to Checkout &rarr;
                    </a>

                    <div style="text-align: center; font-size: 0.75rem; color: var(--color-text-muted); line-height: 1.5;">
                        <p>Instant UPI (GPay, PhonePe, Paytm), Cards & Cash on Delivery accepted.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
@media (max-width: 860px) {
    .cart-layout {
        grid-template-columns: 1fr !important;
    }
    .cart-item-row {
        flex-wrap: wrap;
    }
}
</style>
@endsection

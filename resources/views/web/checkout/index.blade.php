@extends('layouts.app')

@section('title', 'Secure Checkout | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('cart.index') }}">Cart</a>
        <span class="breadcrumb-separator">/</span>
        <span>Checkout</span>
    </nav>

    <h1 style="font-size: clamp(2rem, 3.5vw, 2.75rem); margin-bottom: 2.5rem;">Express Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
        @csrf

        <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 3.5rem; align-items: start;" class="checkout-layout">
            <!-- Left Column: Shipping & Payment Details -->
            <div>
                <!-- 1. Contact Information -->
                <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 2rem; margin-bottom: 2rem;">
                    <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
                        <h3 style="font-size: 1.25rem;">1. Contact Details</h3>
                        @guest
                            <span style="font-size: 0.8125rem; color: var(--color-text-muted);">
                                Already have an account? <a href="{{ route('login') }}" style="color: var(--color-clay); text-decoration: underline;">Log in</a>
                            </span>
                        @endguest
                    </div>

                    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" required value="{{ old('name', $user?->name) }}" class="form-control" placeholder="e.g. Ananya Deshmukh">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" required value="{{ old('email', $user?->email) }}" class="form-control" placeholder="e.g. ananya@example.com">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number (For WhatsApp / SMS updates) *</label>
                            <input type="tel" name="phone" required value="{{ old('phone', $user?->phone) }}" class="form-control" placeholder="e.g. 9820012345">
                        </div>
                    </div>
                </div>

                <!-- 2. Delivery Address -->
                <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 2rem; margin-bottom: 2rem;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 1.5rem;">2. Shipping Address</h3>

                    <!-- Saved Addresses for Logged In User -->
                    @if($savedAddresses->isNotEmpty())
                        <div style="margin-bottom: 1.5rem; background: var(--color-surface-subtle); padding: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border);">
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted); margin-bottom: 0.5rem;">
                                Select from Saved Addresses:
                            </label>
                            <select id="savedAddressSelect" class="form-control" onchange="populateAddress(this)" style="font-size: 0.875rem;">
                                <option value="">-- Choose saved address or type new --</option>
                                @foreach($savedAddresses as $addr)
                                    <option value="{{ json_encode($addr) }}">
                                        {{ $addr->name }} &bull; {{ $addr->address_line_1 }}, {{ $addr->city }} ({{ $addr->postal_code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Address Line 1 (Flat, House no., Building, Street) *</label>
                            <input type="text" name="address_line_1" id="address_line_1" required value="{{ old('address_line_1', $defaultAddress?->address_line_1) }}" class="form-control" placeholder="e.g. Flat 402, Lotus Grandeur, 14th Cross">
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Address Line 2 (Area, Sector, Landmark)</label>
                            <input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $defaultAddress?->address_line_2) }}" class="form-control" placeholder="e.g. Indiranagar, Near Defence Colony Play Ground">
                        </div>

                        <div class="form-group">
                            <label class="form-label">City *</label>
                            <input type="text" name="city" id="city" required value="{{ old('city', $defaultAddress?->city) }}" class="form-control" placeholder="e.g. Bengaluru">
                        </div>

                        <div class="form-group">
                            <label class="form-label">State *</label>
                            <select name="state" id="state" required class="form-control">
                                <option value="">Select State</option>
                                @foreach(['Andhra Pradesh','Assam','Bihar','Delhi','Gujarat','Haryana','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Punjab','Rajasthan','Tamil Nadu','Telangana','Uttar Pradesh','West Bengal'] as $st)
                                    <option value="{{ $st }}" {{ old('state', $defaultAddress?->state) === $st ? 'selected' : '' }}>{{ $st }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">PIN Code *</label>
                            <input type="text" name="postal_code" id="postal_code" required maxlength="6" value="{{ old('postal_code', $defaultAddress?->postal_code) }}" class="form-control" placeholder="6-digit postal PIN code">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" value="India" readonly class="form-control" style="background-color: var(--color-surface-subtle);">
                        </div>
                    </div>

                    @auth
                        <div style="margin-top: 1rem;">
                            <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; cursor: pointer;">
                                <input type="checkbox" name="save_address" value="1" checked>
                                <span>Save this address to my profile for future orders</span>
                            </label>
                        </div>
                    @endauth
                </div>

                <!-- 3. Payment Method Selection (PDF item 24) -->
                <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 2rem;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 1.5rem;">3. Payment Method</h3>

                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <!-- UPI Option -->
                        <label style="display: flex; align-items: flex-start; gap: 1rem; border: 1.5px solid var(--color-clay); background: var(--color-clay-light); padding: 1.25rem; border-radius: var(--radius-sm); cursor: pointer;">
                            <input type="radio" name="payment_method" value="upi" checked style="margin-top: 4px;">
                            <div style="flex: 1;">
                                <div class="flex justify-between items-center" style="margin-bottom: 0.25rem;">
                                    <strong style="font-size: 1rem; color: var(--color-text);">Instant UPI Payment (Recommended)</strong>
                                    <span class="badge badge-clay">Fast &amp; 0% Fee</span>
                                </div>
                                <p style="font-size: 0.8125rem; color: var(--color-text-muted);">
                                    Pay via Google Pay, PhonePe, Paytm, BHIM, or any UPI app using dynamic QR code or UPI ID on next step.
                                </p>
                            </div>
                        </label>

                        <!-- Card Option -->
                        <label style="display: flex; align-items: flex-start; gap: 1rem; border: 1px solid var(--color-border); background: var(--color-surface); padding: 1.25rem; border-radius: var(--radius-sm); cursor: pointer;">
                            <input type="radio" name="payment_method" value="card" style="margin-top: 4px;">
                            <div style="flex: 1;">
                                <strong style="font-size: 1rem; color: var(--color-text); display: block; margin-bottom: 0.25rem;">Credit / Debit Card</strong>
                                <p style="font-size: 0.8125rem; color: var(--color-text-muted);">Visa, MasterCard, RuPay &amp; American Express supported via 256-bit encryption.</p>
                            </div>
                        </label>

                        <!-- Cash on Delivery -->
                        <label style="display: flex; align-items: flex-start; gap: 1rem; border: 1px solid var(--color-border); background: var(--color-surface); padding: 1.25rem; border-radius: var(--radius-sm); cursor: pointer;">
                            <input type="radio" name="payment_method" value="cod" style="margin-top: 4px;">
                            <div style="flex: 1;">
                                <strong style="font-size: 1rem; color: var(--color-text); display: block; margin-bottom: 0.25rem;">Cash on Delivery (COD)</strong>
                                <p style="font-size: 0.8125rem; color: var(--color-text-muted);">Pay in cash or UPI at your doorstep upon arrival.</p>
                            </div>
                        </label>
                    </div>

                    <!-- Delivery Instructions / Notes -->
                    <div class="form-group" style="margin-top: 1.5rem; margin-bottom: 0;">
                        <label class="form-label">Delivery Notes / Special Artisan Requests (Optional)</label>
                        <textarea name="notes" rows="2" placeholder="e.g. Please leave package with security guard or call before delivery" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Review Panel -->
            <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 2rem; position: sticky; top: 100px;">
                <h3 style="font-size: 1.25rem; margin-bottom: 1.25rem; border-bottom: 1px solid var(--color-border); padding-bottom: 0.75rem;">
                    Order Summary ({{ $items_count }} items)
                </h3>

                <!-- Cart Items List -->
                <div style="display: flex; flex-direction: column; gap: 1rem; max-height: 320px; overflow-y: auto; margin-bottom: 1.5rem; padding-right: 0.5rem;">
                    @foreach($cart->items as $item)
                        <div class="flex items-center gap-2">
                            <img src="{{ $item->product->primary_image_url }}" alt="{{ $item->product->name }}" style="width: 52px; height: 65px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--color-border); flex-shrink: 0;">
                            <div style="flex: 1; min-width: 0;">
                                <h4 style="font-size: 0.875rem; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->product->name }}</h4>
                                <span style="font-size: 0.75rem; color: var(--color-text-muted);">Qty: {{ $item->quantity }}</span>
                            </div>
                            <span style="font-weight: 600; font-size: 0.875rem;">₹{{ number_format($item->total, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Price Calculations -->
                <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.9375rem; border-top: 1px solid var(--color-border); padding-top: 1.25rem; margin-bottom: 1.5rem;">
                    <div class="flex justify-between">
                        <span class="text-muted">Subtotal:</span>
                        <span style="font-weight: 600;">₹{{ number_format($subtotal, 2) }}</span>
                    </div>

                    @if($discount > 0)
                        <div class="flex justify-between" style="color: var(--color-clay);">
                            <span>Discount ({{ $coupon->code }}):</span>
                            <span style="font-weight: 600;">&minus; ₹{{ number_format($discount, 2) }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between">
                        <span class="text-muted">Pan-India Shipping:</span>
                        @if($shipping == 0)
                            <span style="font-weight: 600; color: var(--color-success);">FREE</span>
                        @else
                            <span style="font-weight: 600;">₹{{ number_format($shipping, 2) }}</span>
                        @endif
                    </div>

                    <div class="flex justify-between text-xs text-muted">
                        <span>GST 5% (Included):</span>
                        <span>₹{{ number_format($tax, 2) }}</span>
                    </div>

                    <div class="flex justify-between items-baseline" style="font-size: 1.35rem; font-weight: 700; color: var(--color-text); border-top: 1px solid var(--color-border-subtle); padding-top: 0.75rem;">
                        <span>Grand Total:</span>
                        <span>₹{{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-bottom: 1rem;">
                    Place Order &rarr;
                </button>

                <p style="font-size: 0.75rem; color: var(--color-text-muted); text-align: center; line-height: 1.5;">
                    By placing your order, you agree to Oreon Living's <a href="{{ route('pages.terms') }}" target="_blank" style="text-decoration: underline;">Terms &amp; Conditions</a> and <a href="{{ route('pages.return-policy') }}" target="_blank" style="text-decoration: underline;">Return Policy</a>.
                </p>
            </div>
        </div>
    </form>
</div>

<script>
    function populateAddress(selectElement) {
        if (!selectElement.value) return;
        const addr = JSON.parse(selectElement.value);
        document.getElementById('address_line_1').value = addr.address_line_1 || '';
        document.getElementById('address_line_2').value = addr.address_line_2 || '';
        document.getElementById('city').value = addr.city || '';
        document.getElementById('state').value = addr.state || '';
        document.getElementById('postal_code').value = addr.postal_code || '';
    }
</script>

<style>
@media (max-width: 900px) {
    .checkout-layout {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection

@extends('layouts.app')

@section('title', 'Saved Addresses | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('account.dashboard') }}">My Account</a>
        <span class="breadcrumb-separator">/</span>
        <span>Addresses</span>
    </nav>

    <div style="display: grid; grid-template-columns: 240px 1fr; gap: 3rem; align-items: start;" class="account-layout">
        <!-- Sidebar -->
        <aside style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 1.5rem;">
            <nav style="display: flex; flex-direction: column; gap: 0.35rem;">
                <a href="{{ route('account.dashboard') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-text);">
                    Dashboard Overview
                </a>
                <a href="{{ route('account.orders') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-text);">
                    Order History
                </a>
                <a href="{{ route('account.addresses') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; font-weight: 600; background: var(--color-clay-light); color: var(--color-clay);">
                    Saved Addresses
                </a>
                <a href="{{ route('wishlist.index') }}" style="padding: 0.65rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.875rem; color: var(--color-text);">
                    Saved Pieces (Wishlist)
                </a>
            </nav>
        </aside>

        <!-- Addresses Content -->
        <div>
            <div class="flex justify-between items-center" style="margin-bottom: 2rem;">
                <div>
                    <h1 style="font-size: 2rem; margin-bottom: 0.25rem;">Address Book</h1>
                    <p class="text-muted">Manage your default shipping destinations.</p>
                </div>
                <button type="button" onclick="document.getElementById('newAddressForm').style.display='block'" class="btn btn-primary btn-sm">
                    &plus; Add New Address
                </button>
            </div>

            <!-- New Address Form (Hidden by default or toggled) -->
            <div id="newAddressForm" style="display: none; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 2rem; margin-bottom: 2.5rem;">
                <h3 style="font-size: 1.25rem; margin-bottom: 1.5rem;">New Delivery Destination</h3>
                <form action="{{ route('account.addresses.store') }}" method="POST">
                    @csrf
                    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Recipient Name *</label>
                            <input type="text" name="name" required class="form-control" placeholder="Full name">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" required class="form-control" placeholder="Mobile number">
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Address Line 1 *</label>
                            <input type="text" name="address_line_1" required class="form-control" placeholder="Flat, House no., Apartment, Street">
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Address Line 2 / Landmark</label>
                            <input type="text" name="address_line_2" class="form-control" placeholder="Landmark, Area">
                        </div>

                        <div class="form-group">
                            <label class="form-label">City *</label>
                            <input type="text" name="city" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-label">State *</label>
                            <select name="state" required class="form-control">
                                <option value="">Select State</option>
                                @foreach(['Andhra Pradesh','Assam','Bihar','Delhi','Gujarat','Haryana','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Punjab','Rajasthan','Tamil Nadu','Telangana','Uttar Pradesh','West Bengal'] as $st)
                                    <option value="{{ $st }}">{{ $st }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">PIN Code *</label>
                            <input type="text" name="postal_code" required maxlength="6" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Set as Default</label>
                            <label style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem; cursor: pointer;">
                                <input type="checkbox" name="is_default" value="1">
                                <span>Make this my primary address</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-2" style="margin-top: 1rem;">
                        <button type="submit" class="btn btn-primary">Save Address</button>
                        <button type="button" onclick="document.getElementById('newAddressForm').style.display='none'" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Saved Addresses Grid -->
            @if($addresses->isEmpty())
                <div style="background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 3rem; text-align: center;">
                    <p class="text-muted">You have no saved addresses yet.</p>
                </div>
            @else
                <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    @foreach($addresses as $addr)
                        <div style="background: var(--color-surface); border: 1.5px solid {{ $addr->is_default ? 'var(--color-clay)' : 'var(--color-border)' }}; border-radius: var(--radius-sm); padding: 1.5rem; position: relative;">
                            @if($addr->is_default)
                                <span class="badge badge-clay" style="margin-bottom: 0.75rem;">Default Shipping</span>
                            @endif
                            <h4 style="font-size: 1.05rem; font-weight: 600; margin-bottom: 0.35rem;">{{ $addr->name }}</h4>
                            <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 1rem;">
                                {{ $addr->formatted_address }}<br>
                                Phone: {{ $addr->phone }}
                            </p>

                            <form action="{{ route('account.addresses.delete', $addr->id) }}" method="POST" onsubmit="return confirm('Delete this address?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="font-size: 0.75rem; color: var(--color-danger); text-decoration: underline;">
                                    Delete Address
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
@media (max-width: 860px) {
    .account-layout {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection
